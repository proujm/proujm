<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Banner;
use Illuminate\Support\Str;
use Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class SearchController extends Controller
{
    public function searchGet($str)
    {
        $products = Product::likeTitleFull($str, 2);
        return view('search')
            ->with('horisontalBanners', Banner::randHorisontal(3))
            ->with('products', $products)
            ->with('searchStr', $str);
    }
    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'searchInput' => 'required|max:100'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input());
        }
        return redirect(route('web.searchGet', $request->input('searchInput')));
    }


    public function autocomplete(Request $request){
        $title = Str::lower(Input::get('query'));
        $products = Product::likeTitle($title);
        
        $arr = array();
        foreach ($products as $product){
            array_push($arr, array(
                "value" => $product->title, "data" => $product->id
            ));
        }
        $res = array();
        $res['suggestions'] = $arr;

        return Response()->json($res);
    }
}
