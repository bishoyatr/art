<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_line;
use App\Models\ProductYearTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('parent_id')->get();
         return view('dashboard.category.category')->with(['categories'=>$categories]);
    }

    public function create()
    {
        return view('dashboard.category.create');
    }

    public function store(CreateCategoryRequest $request)
    {

        Category::create($request->except('_token'));

        return redirect()->route('category.index')->with(['success' => 'category is added successfully']);
    }



    public function edit($category_id)
    {
        $category=Category::find($category_id);
        if (!$category)
        {
            return redirect()->route('category.index')->with('error','هذا القسم غير موجود');

        }
        return view('dashboard.category.edit')->with(['category'=>$category]);
    }

    public function update($category_id,CreateCategoryRequest $request)
    {

        $category=Category::findOrfail($category_id);
        $category->update($request->except('_token'));
        $sub_categories=Category::where('parent_id',$category_id)->get();
        foreach ($sub_categories as $sub_category )
        {
            $sub_category->update(['category_type'=>$category->category_type]);
            $produts=Product::where('category_id',$sub_category->id)->get();
            foreach ($produts as $produt)
            {
                $produt->update(['product_status'=>$category->category_type]);
                $produt_lines=Product_line::where('product_id',$produt->id)->get();

                foreach ($produt_lines as $produt_line)
                {
                  $update= $produt_line->update(['product_line_status'=>$category->category_type]);
                }

            }
        }

        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }

    public function destroy($category_id)
    {
           $category=Category::findOrfail($category_id);

            $category->delete();
           $sub_category=Category::where('parent_id',$category_id)->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully');

    }

}
