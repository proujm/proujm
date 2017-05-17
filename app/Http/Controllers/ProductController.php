<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\Comment;
use App\Models\Banner;

class ProductController extends Controller
{
    public function index()
    {
        return view('products')
            ->with('products', Product::getAllProductsPaginate(12))
            ->with('horisontalBanners', Banner::randHorisontal(3));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $product = Product::find($id);
        if($product){
            $product->view_count+=1;
            $product->save();
            return view('product')
                ->with('product', $product)
                ->with('mainImage', ProductImages::getMainImage($product))
                ->with('comments', Comment::getCommentsPaginate(5, $id))
                ->with('horisontalBanners', Banner::randHorisontal(3));
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
