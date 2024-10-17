<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\CreateSubCategoryRequest;
use App\Models\Category;
use App\Models\Type;
use DB;

class SubCategoryController extends Controller
{
    public function index($id)
    {
        $categories = Category::with('parentCategory')->where('parent_id',$id)->get();
        $types = Type::all();
        return view('dashboard.subcategory.subcategory')->with(['categories'=>$categories,'parent_id'=>$id, 'types'=>$types]);
    }

    public function create($id)
    {
        $parent_categories = Category::select('id','name','category_type')->where('id',$id)->first();
        return view('dashboard.subcategory.create')->with(['categories'=>$parent_categories]);
    }

    public function store(CreateSubCategoryRequest $request)
    {
        $category= Category::create($request->except('_token'));
        return redirect()->route('subcategory.index',$category->parent_id)->with(['success' => 'category is added successfully']);
    }

    public function edit($category_id)
    {
        $category=Category::find($category_id);
        if (!$category)
        {
            return redirect()->route('subcategory.index',$category->parent_id)->with('error','هذا القسم غير موجود');
        }
        $types = Type::where('process',1)->get();

        $main_products = DB::table('categories')
        ->join('types','categories.category_type','=','types.id')
        ->selectRaw('categories.id as cat_id, categories.name as cat_name, categories.parent_id, categories.is_active as cat_is_active, category_type, types.id as type_id, types.name as type_name')
        ->whereNull('parent_id')
        ->get();

        return view('dashboard.subcategory.edit')
            ->with(['category'=>$category,'mainProducts'=> $main_products,'types'=> $types]);
    }

    public function update($category_id,CreateSubCategoryRequest $request)
    {
        $category = Category::findOrfail($category_id);
        $parent_category = Category::find($request->parent_id);
        if($request->category_type != $parent_category->category_type){
            return redirect()->route('subcategory.edit',$category->id)->with('error', 'Category is not found in that category type.');
        }
        $category->update($request->except('_token'));

        return redirect()->route('subcategory.index',$category->parent_id)->with('success', 'Category updated successfully');
    }

    public function destroy($category_id)
    {
        $category=Category::findOrfail($category_id);
        $parent_id=$category->parent_id;
        $category->delete();
        return redirect()->route('subcategory.index',$parent_id)->with('success', 'Category deleted successfully');
    }
}