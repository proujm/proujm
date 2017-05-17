<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function index()
    {
        return view('admin/comments')
            ->with('comments', Comment::getAllCommentsPaginate(10))
            ->with('product', 'all');
    }
    
    public function create()
    {
        //
    }
    
    public function store(Request $request)
    {
        //
    }
    
    public function show($productId)
    {
        return view('admin/comments')
            ->with('comments', Comment::getCommentsPaginate(10, $productId))
            ->with('product', Product::find($productId)->title);
    }
    
    public function edit($id)
    {
        return view('admin/commentEdit')
            ->with('comment', Comment::find($id))
            ->with('products', Product::getAllProductsId());
    }
    
    public function update(Request $request, $id)
    {
        $submit = $request->input("submitSave");
        if(isset($submit)) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|max:255',
                'commentTextEdit' => 'required|max:25000',
                'commentProduct' => 'required|max:500'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withInput($request->input())->withErrors($validator);
            }
            $comment = Comment::find($id);
            $comment->name = $request->input('email');
            $comment->text = $request->input('commentTextEdit');
            $comment->product_id = $request->input('commentProduct');
            $comment->save();
        }
        return redirect(route('comment.index'));
    }
    
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect(route('comment.index'));
    }
}
