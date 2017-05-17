<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
//связка с другими таблицами
    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id');
    }
    public function banners()
    {
        return $this->hasMany('App\Models\Banner', 'user_id');
    }
    public function news()
    {
        return $this->hasMany('App\Models\News', 'user_id');
    }
//-------------------------------

    //возвращает всех пользователей
    public static function getAllUsers()
    {
        return self::all();
    }
    //возвращает все подкатегории - пагинация
    public static function getAllUsersPaginate($count)
    {
        if($count<10){
            return self::orderBy('id','desc')->paginate(10);
        }
        return self::orderBy('id','desc')->paginate($count);
    }
}
