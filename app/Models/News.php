<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    protected $table = 'news';
//связка с другими таблицами
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
//-------------------------
    public static function News() {
        return self::all();
    }
    public static function NewsPaginate($count) {
        if($count<=0){
            return;
        }
        return self::orderBy('id','desc')->paginate($count);
    }
    public static function NewsByUserId($userId) {
        return self::where('user_id','=',$userId)->get();
    }
    public static function NewsByUserIdPaginate($userId, $count) {
        if($count<=0){
            return;
        }
        return self::where('user_id','=',$userId)->orderBy('id','desc')->paginate($count);
    }
    public static function Rand(){
        $lastItems = self::orderBy('id','desc')->take(5)->get();
        $num = rand(0, count($lastItems) - 1);
        return self::orderBy('id','desc')->take(5)->skip($num)->first();
    }
    public static function deleteImage($item){
        if($item->image){
            Storage::delete('images/news/' . $item->image);
        }
    }
}
