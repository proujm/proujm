<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'products';
    public $fillable = ['title','description'];

//связка с другими таблицами
    public function images()
    {
        return $this->hasMany('App\Models\ProductImages', 'product_id');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'product_id');
    }
//-------------------------

    //возвращает продукт по id
    public static function getProductById($id)
    {
        return self::where('id', '=', $id)->firstOrFail();
    }
    //возвращает все продукты
    public static function getAllProducts()
    {
        return self::all();
    }
    //возвращает все продукты
    public static function getAllProductsId()
    {
        return self::select('id', 'title')->get();
    }
    //возвращает продукты по id подкатегории
    public static function getProductsByCategoryId($id)
    {
        return self::where('category_id', '=', $id)->get();
    }
    //возвращает все продукты
    public static function getAllProductsPaginate($count)
    {
        if($count<=0){
            return self::orderBy('id','desc')->paginate(8);
        }
        return self::orderBy('id','desc')->paginate($count);
    }
    //возвращает определенное в рандомном порядке колличество продуктов
    public static function getLimitProducts($count) {
        $random_quote = self::orderByRaw("RAND()")->get();
        return $random_quote->take($count);
    }
    //возвращает кол-во стандартных изображений в продукте
    public static function getCountStandartImages($product) {
        $count = 0;
        foreach ($product->images as $image){
            if($image->name == 'no-image.jpg'){
                $count++;
            }
        }
        return $count;
    }
    public static function deleteAllImgs($idProduct) {
        $product = self::find($idProduct);
        foreach ($product->images as $image) {
            ProductImages::deleteImg($image, $idProduct);
        }
    }
    public static function checkMainImgName($productId, $mainImgId = '', $mainImgN = '') {
        $product = self::find($productId);

        if($mainImgId != ''){
            if($mainImgN){
                $product->mainImgName = $mainImgN;
                $product->save();
                return;
            }
            $product->mainImgName = ProductImages::find($mainImgId)->name;
            $product->save();
            return;
        }

        $images = $product->images;
        if(count($images) < 1){
            $product->mainImgName = 'noImg.jpg';
            $product->save();
            return;
        }
        foreach ($images as $image){
            if($image->name == $product->mainImgName){
                return;
            }
        }
        $product->mainImgName = $images->first()->name;
        $product->save();
    }
    public static function likeTitle($title) {
        return self::select('id', 'title')->where('title', 'LIKE', $title.'%')->groupBy('title')->get();
    }
    public static function likeTitleFull($title, $count) {
        if($count<=0){
            return;
        }
        return self::where('title', 'like', $title.'%')->orderBy('id','desc')->paginate($count);
    }
}
