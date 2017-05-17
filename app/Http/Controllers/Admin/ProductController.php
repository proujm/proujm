<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\Category;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin/product')
            ->with('products', Product::getAllProductsPaginate(10));
    }

    public function create()
    {
        return view('admin/productCreate')
            ->with('categories', Category::getAllCategory());
    }
    
    public function store(Request $request, Product $product)
    {
        $submit = $request->input("submitAdd");
        if(isset($submit)) {
            $validator = Validator::make($request->all(), [
                'new_title_product' => 'required|max:255',
                'category_id' => 'required|max:500'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withInput($request->input())->withErrors($validator);
            }
            $product = $this->addInputs($product, $request);
            $product->mainImgName = 'noImg.jpg';

            DB::beginTransaction();
            try {
                $product->save();
                $this->addImages($request, $product);
            }
            catch(Exception $ex){
                DB::rollBack();
                return redirect()->back()->withInput($request->input())->withErrors($validator);
            }
            DB::commit();
            Product::checkMainImgName($product->id);
        }
        return redirect(route('product.index'));
    }

    public function show($id)
    {
        return redirect(route('product.index'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $mainImg=[];
        $mainImg =  ProductImages::where('name','=',$product->mainImgName)->get();

        return view('admin/productEdit')
            ->with('categories', Category::getAllCategory())
            ->with('product', $product)
            ->with('mainImgId', $mainImg);
    }
    
    public function update(Request $request, $id)
    {
        $submit = $request->input("submitSave");
        if(isset($submit)) {
            $product = Product::find($id);
            $validator = Validator::make($request->all(), [
                'new_title_product' => 'required|max:255',
                'new_price_product' => 'required|max:255',
                'category_id' => 'required|max:500'
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()->withInput($request->input())->withErrors($validator);
            }
            $product->title = $request->input('new_title_product');
            $product->category_id = $request->input('category_id');
            $product->description = $request->input('new_description_product');
            $product->price = $request->input('new_price_product');
            $product->status = $request->input('new_status_product');
            $product->view_count = $request->input('new_viewcount_product');

            $mainImgId = $request->input('mainImage');
            $mainImg = '';
            DB::beginTransaction();
            try {
                $product->save();
                $this->deleteImages($request, $product);
                $mainImg = $this->addImages($request, $product, $mainImgId);
            }
            catch(Exception $ex){
                DB::rollBack();
                return redirect()->back()->withInput($request->input())->withErrors($validator);
            }
            DB::commit();
            
            if($mainImg!=$mainImgId){
                Product::checkMainImgName($product->id, $mainImgId, $mainImg);
            }
            else{
                Product::checkMainImgName($product->id, $mainImg);
            }
            
        }
        return redirect(route('product.index'));
    }
    
    public function destroy($id)
    {
        //находим товар
        $product = Product::find($id);
        DB::beginTransaction();
        try{
            //если есть картинки удаляем
            if(count($product->images) > 0){
                ProductImages::deleteImages($product->images);
            }
            $product->delete();
        }
        catch(Exception $ex){
            DB::rollBack();
        }
        DB::commit();
        return redirect()->back();
    }

    //добавляет в бд загруженные изображения из запроса
    private function addImages($request, $product, $mainImgId=''){
        if ($request->file('img')) {
            $files = $request->file('img');
            foreach ($files as $file) {
                $fileName = date_create('now')->format('YmdHis') . '__' . $file->getClientOriginalName();
                if($mainImgId == $file->getClientOriginalName()){
                    $mainImgId = $fileName;
                }
                $product->mainImgName = $fileName;
                //сохраняем картинку 2-х размеров и кладем в папки
                Image::make($file)->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('../public/images/product/min/' .$fileName);
                Image::make($file)->resize(640, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('../public/images/product/normal/' . $fileName);

                //добавляем картинку в бд
                $ProductImages = new ProductImages();
                $ProductImages->product_id = $product->id;
                $ProductImages->name = $fileName;
                $ProductImages->save();
            }
        }
        return $mainImgId;
    }
    //проверяет удаляет картинки из бд и с сервера
    private function deleteImages($request, $product){
        $dbFilesStr = $request->input('dbImg');//список картинок в строке через запятую
        $differenceImgs = [];
        if($dbFilesStr != ''){//если строка картинок с сайта не пустая
            if(substr_count($dbFilesStr,',') > 1){
                $dbFilesStr=substr_replace($dbFilesStr, "", -1);//обрезаем последний символ
            }
            $dbFilesMass = explode(',', $dbFilesStr);//распарсеная строка, массив картинок из бд
            $differenceImgs = ProductImages::getDifference($dbFilesMass, $product->id);//разница картинок пришедших с сайта и лежащих в бд(удаленные)
        } else{//если строка картинок с сайта пустая
            $differenceImgs = ProductImages::allImgsByProductId($product->id); //брем все картинки продукта
        }

        foreach ($differenceImgs as $dbFile){
            $countBind = ProductImages::countBindings($dbFile->name);//колличество связей с картинкой
            if($countBind == 1){//удаляем с сервера картинку если эта картинка только у 1 товара
                Storage::delete('images/product/min/' . $dbFile->name);//удаляем сам файл картинки
                Storage::delete('images/product/normal/' . $dbFile->name);
            }
            ProductImages::deleteImg($dbFile->name, $product->id);//удаляем из бд запись с ссылкой на картинку
        }
    }
    //добавляет в продукт введенные значения
    private function addInputs($product, $request){
        $product->category_id = $request->input('category_id');
        if($request->input('new_title_product')){
            $product->title = $request->input('new_title_product');
        }else{
            $product->title = '';
        }
        if($request->input('new_price_product')){
            $product->price = $request->input('new_price_product');
        }else{
            $product->price = 0;
        }
        if($request->input('new_description_product')){
            $product->description = $request->input('new_description_product');
        }else{
            $product->description = '';
        }
        if($request->input('new_status_product')){
            $product->status = $request->input('new_status_product');
        }else{
            $product->status = '';
        }
        if($request->input('new_viewcount_product')){
            $product->view_count = $request->input('new_viewcount_product');
        }else{
            $product->view_count = '0';
        }
        return $product;
    }
}
