<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    protected $table = 'banners';
//связка с другими таблицами
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
//-------------------------
    public static function allBanners()
    {
        return self::where('iscarusel','=',0)->get();
    }
    public static function allBannersPaginate($count)
    {
        if($count<5){
            return self::where('iscarusel','=',0)->orderBy('id','desc')->paginate(5);
        }
        return self::where('iscarusel','=',0)->orderBy('id','desc')->paginate($count);
    }
    public static function deleteImage($banner)
    {
        if($banner->img_name){
            Storage::delete('images/banners/' . $banner->img_name);
        }
    }
    public static function randHorisontal($count)
    {
        $banners = Banner::allBanners();
        if($count <= 0 || $count > count($banners)){
            return;
        }
        $random_quote = self::where('iscarusel','=',0)->select('img_name', 'redirect_url')->orderByRaw("RAND()")->get();
        if(!$random_quote){
            return;
        }
        return $random_quote->take($count);
    }
//-------------------------
    public static function allCaruselPaginate($count)
    {
        if($count<5){
            return self::where('iscarusel','=',1)->orderBy('id','desc')->paginate(5);
        }
        return self::where('iscarusel','=',1)->orderBy('id','desc')->paginate($count);
    }
    public static function allCaruselBanners()
    {
        return self::where('iscarusel','=',1)->select('img_name', 'redirect_url')->orderByRaw("RAND()")->get();
    }
    public static function deleteCaruselImage($banner)
    {
        if($banner->img_name){
            Storage::delete('images/carusel/' . $banner->img_name);
        }
    }
}
