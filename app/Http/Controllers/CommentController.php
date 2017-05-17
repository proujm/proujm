<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function index()
    {
        //
    }
    
    public function create()
    {
        //
    }
    
    public function store(Request $request, $productId)
    {
        $submit = $request->input("submitAdd");
        if(isset($submit)) {
            $validator = Validator::make($request->all(), [
                'commentName' => 'required|max:255',
                'newComment' => 'required|max:25000'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withInput($request->input())->withErrors($validator);
            }
            $comment = new Comment();
            $comment->name = $request->input('commentName');
            $comment->text = $request->input('newComment');
            $comment->product_id = $productId;
            $comment->save();
        }
        return redirect()->back();
    }

    public function show($id)
    {
        //
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
