<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImages extends Model
{
    protected $table = 'images';
//связка с другими таблицами
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
//-------------------------
    public static function getAllImages()
    {
        return self::all();
    }
    public static function getImageByProductId($id)
    {
        $image = self::where('product_id','=',$id)->first();
        if(is_null($image)){
            return ;
        }
        return $image;
    }
    public static function allImgsByProductId($id)
    {
        return self::where('product_id','=',$id)->get();
    }
    public static function imgByName($name){
        return self::where('name','=',$name)->get();
    }
    public static function countBindings($imgName)
    {
        $images = self::where('name','=',$imgName)->get();
        return count($images);
    }
    public static function deleteImg($imgName, $idProduct)
    {
        self::where('name','=',$imgName)->where('product_id','=',$idProduct)->first()->delete();
    }
    public static function deleteImgs($imgNames, $idProduct)
    {
        foreach ($imgNames as $imgName){
            ProductImages::deleteImg($imgName, $idProduct);
        }
    }
    public static function deleteImages($imagesMass)
    {
        foreach ($imagesMass as $img){
            $countBind = ProductImages::countBindings($img->name);//колличество связей с картинкой
            if($countBind == 1){//удаляем с сервера картинку если эта картинка только у 1 товара
                Storage::delete('images/product/min/' . $img->name);//удаляем сам файл картинки
                Storage::delete('images/product/normal/' . $img->name);
            }
            self::where('id','=',$img->id)->delete();
        }
    }
    public static function getDifference($imgMass, $idProduct)
    {
        $realImgMass = self::where('product_id','=',$idProduct)->get();
        $result = [];
        foreach ($realImgMass as $realImg){
            if(!in_array($realImg->name, $imgMass)){
                array_push($result, $realImg);
            }
        }
        return $result;
    }
    public static function getMainImage($product){
        $product_images = self::where('product_id','=',$product->id)->get();
        foreach ($product_images as $image){
            if($image->name == $product->mainImgName){
                return $image;
            }
        }
        return '';
    }
}
