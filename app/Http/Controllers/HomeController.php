<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Banner;
use App\Models\News;

class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function index()
    {
        return view('home')
            ->with('products', Product::getLimitProducts(9))
            ->with('horisontalBanners', Banner::randHorisontal(3))
            ->with('caruselBanners', Banner::allCaruselBanners())
            ->with('newsItem', News::Rand());
    }
}
