<?php


namespace App\Helpers;

class Helpers
{
    public static function userMenu()
    {
        return view('_helpers.userMenu');
    }
    public static function adminMenu()
    {
        return view('_helpers.adminMenu');
    }
    public static function errorMsg($errors)
    {
        return view('_helpers.errorMsg')->with('errors', $errors);
    }
    //выпадающий список
    //принимает: список, выбранный селект по умолчанию, первый селект, доп атрибуты, заблокировать, имя опции которую выводить
    public static function select($options = [], $selected = 1, $first_option = '', $attrs = [], $isDisabled = 0, $option_name = 'title', $selected_name = 'id')
    {
        return view('_helpers.select')
            ->with('options', $options)
            ->with('selected', $selected)
            ->with('first_option', $first_option)
            ->with('attrs', $attrs)
            ->with('isDisabled', $isDisabled)
            ->with('option_name', $option_name)
            ->with('selected_name', $selected_name);
    }
    public static function imageForm($image, $columns)
    {
        return view('_helpers.imageForm')->with('image', $image)->with('columns', $columns);
    }
    public static function horisontalBanner($horisontalBanners)
    {
        return view('_helpers.horisontalBanner')->with('horisontalBanners', $horisontalBanners);
    }
    public static function makeCarusel($caruselBanners)
    {
        return view('_helpers.carusel')->with('caruselBanners', $caruselBanners);
    }
    // получение ID видео из URL
    public static function getYoutubeVideoID($url){
        // допустимые доменые имена в ссылке
        $names = array('www.youtube.com','youtube.com');
        // разбор адреса
        $up = parse_url($url);
        // проверка параметров
        if (isset($up['host']) && in_array($up['host'],$names) &&
            isset($up['query']) && strpos($up['query'],'v=') !== false){
            // достаем параметр ID
            $lp = explode('v=',$url);
            // отсекаем лишние параметры
            $rp = explode('&',$lp[1]);
            // возвращаем строку, либо false
            return (!empty ($rp[0]) ? $rp[0] : false);
        }
        return false;
    }
    public static function newsItem($newsItem){
        return view('_helpers.newsItem')->with('item', $newsItem);
    }
}