<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin/category')->with('categories', Category::getAllCategoryPaginate(10));
    }

    public function create()
    {
        return redirect(route('category.index'));
    }

    public function store(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'newcategory' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return redirect(route('category.index'))
                ->withErrors($validator->errors()->all())
                ->withInput();
        } else{
            $category->title = $request->input('newcategory');
            $category->save();
        }
        return redirect(route('category.index'));
    }

    public function show($id)
    {
        return redirect(route('category.index'));
    }

    public function edit($id)
    {
        return view('admin/categoryEdit')
            ->with('category', Category::find($id));
    }

    public function update(Request $request, $id)
    {
        $submit = $request->input("submitSave");
        if(isset($submit)) {
            $Category = Category::find($id);
            $validator = Validator::make($request->all(), [
                'newcategory' => 'required|max:255'
            ]);
            if ($validator->fails()) {
                return view('admin/categoryEdit')
                    ->with('category', Category::find($id))
                    ->withErrors($validator->errors()->all());
            }
            $Category->title = $request->input('newcategory');
            $Category->save();
        }
        return redirect(route('category.index'));
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        //если есть продукты, то запрещаем удалить
        if(count($category->products) > 0){
            $validator = Validator::make([], []);
            $validator->errors()->add('', 'Невозможно удалить: у категории есть продукты');
            return redirect(route('category.index'))->withErrors($validator->errors()->all());
        }
        $category->delete();
        return redirect(route('category.index'))->withInput();
    }
}
