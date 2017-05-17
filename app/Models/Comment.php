<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $table = 'comments';
//связка с другими таблицами
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
//-------------------------

    //возвращает коментарий по id
    public static function getCommentById($id)
    {
        return self::where('id', '=', $id)->firstOrFail();
    }
    //возвращает все коментарии
    public static function getAllComments()
    {
        return self::all();
    }
    public static function getAllCommentsPaginate($count)
    {
        if($count<5){
            return self::orderBy('id','desc')->paginate(5);
        }
        return self::orderBy('id','desc')->paginate($count);
    }
    public static function getCommentsPaginate($count, $productId)
    {
        if($count<5){
            return self::where('product_id', '=', $productId)->orderBy('id','desc')->paginate(5);
        }
        return self::where('product_id', '=', $productId)->orderBy('id','desc')->paginate($count);
    }
}
