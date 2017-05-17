<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'categories';
//связка с другими таблицами
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'category_id');
    }
//-------------------------

    //возвращает максимальный id
    public static function getMaxCategoryId()
    {
        return self::select('id')->max('id');
    }
    //возвращает все категории
    public static function getAllCategory()
    {
        return self::all();
    }
    //возвращает все категории с указанным кол-вом пагинации
    public static function getAllCategoryPaginate($count)
    {
        if($count <= 10){
            return self::orderBy('id','desc')->paginate(10);
        }
        return self::orderBy('id','desc')->paginate($count);
    }
    //возвращает все категории по имени
    public static function getByTitleName($name)
    {
        return self::where('title','=',$name)->first('id');
    }
}
