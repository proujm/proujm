<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $table = 'roles';
//связка с другими таблицами
    public function users()
    {
        return $this->hasMany('App\Models\Role', 'role_id');
    }
//-------------------------
    public static function getRoleUserId()
    {
        return self::where('title','=','user')->firstOrFail()->id;
    }

    public static function getAllRoles()
    {
        return self::All();
    }
}
