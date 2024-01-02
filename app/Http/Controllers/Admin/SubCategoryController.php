<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\CreateSubCategoryRequest;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function index($id)
    {
         $categories = Category::with('parentCategory')->where('parent_id',$id)->get();
         return view('dashboard.subcategory.subcategory')->with(['categories'=>$categories,'parent_id'=>$id]);
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
     $parent_categories = Category::select('id','name')->whereNull('parent_id')->get();

        return view('dashboard.subcategory.edit')
            ->with(['category'=>$category,'parent_categories'=>$parent_categories]);
    }

    public function update($category_id,CreateSubCategoryRequest $request)
    {

        $category=Category::findOrfail($category_id);
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
