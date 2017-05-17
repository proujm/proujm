<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Banner;

class CaruselController extends Controller
{
    public function index()
    {
        return view('admin/carusel')
            ->with('banners', Banner::allCaruselPaginate(10));
    }
    
    public function create()
    {
        return view('admin/caruselCreate');
    }
    
    public function store(Request $request, Banner $banner)
    {
        $submit = $request->input("submitAdd");
        if(isset($submit)) {
            $validator = Validator::make($request->all(), [
                'bannerUrl' => 'max:255',
                'bannerNote' => 'max:2500'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withInput($request->input())->withErrors($validator);
            }
            if(!$request->file('img')){
                $validator->errors()->add('', 'Вы не выбрали изображение');
                return redirect()->back()->withInput($request->input())->withErrors($validator);
            }
            if($request->input('bannerUrl')){
                $banner->redirect_url = $request->input('bannerUrl');
            }
            if($request->input('bannerNote')){
                $banner->note = $request->input('bannerNote');
            }
            $banner->iscarusel = 1;
            $banner->user_id = Auth()->user()->id;

            $file = $request->file('img');//загруженная картинка
            if ($file) {
                $fileName = date_create('now')->format('YmdHis') . '__' . $file->getClientOriginalName();
                $banner->img_name = $fileName;
                if(strpos($fileName,'.gif') !== false){//если это гифка не меняем ее размер(стает просто картинкой)
                    $file->move('images/carusel/', $fileName);
                }else{//остальные все изображения меняем размер
                    Image::make($file)->resize(1200, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save('../public/images/carusel/' .$fileName);
                }
            }
            $banner->save();
        }
        return redirect(route('carusel.index'));
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        return view('admin/caruselEdit')
            ->with('banner', Banner::find($id));
    }
    
    public function update(Request $request, $id)
    {
        $submit = $request->input("submitSave");
        if(isset($submit)) {
            $validator = Validator::make($request->all(), [
                'bannerUrl' => 'max:255',
                'bannerNote' => 'max:2500'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withInput($request->input())->withErrors($validator);
            }
            $banner = Banner::find($id);
            if($request->input('bannerUrl')){
                $banner->redirect_url = $request->input('bannerUrl');
            } else{
                $banner->redirect_url = '';
            }
            if($request->input('bannerNote')){
                $banner->note = $request->input('bannerNote');
            } else{
                $banner->note = '';
            }
            $banner->iscarusel = 1;
            $banner->user_id = Auth()->user()->id;
            $file = $request->file('img');//загруженная картинка
            if ($file) {
                Storage::delete('images/carusel/' . $banner->img_name);
                $fileName = date_create('now')->format('YmdHis') . '__' . $file->getClientOriginalName();
                $banner->img_name = $fileName;
                if(strpos($fileName,'.gif') !== false){//если это гифка не меняем ее размер(стает просто картинкой)
                    $file->move('images/carusel/', $fileName);
                }else{//остальные все изображения меняем размер
                    Image::make($file)->resize(1200, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save('../public/images/carusel/' .$fileName);
                }
            }

            $banner->save();
        }
        return redirect(route('carusel.index'));
    }
    
    public function destroy($id)
    {
        $banner = Banner::find($id);
        Banner::deleteCaruselImage($banner);
        $banner->delete();
        return redirect()->back();
    }
}
