<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\News;

class InfoController extends Controller
{
    public function index()
    {
        return view('info')
            ->with('horisontalBanners', Banner::randHorisontal(3))
            ->with('news', News::NewsPaginate(5));
    }
}
