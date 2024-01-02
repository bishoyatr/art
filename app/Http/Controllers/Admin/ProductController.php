<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\CreateSubCategoryRequest;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index($id)
    {
        $products = Product::where('category_id',$id)->with('category')->get();
         return view('dashboard.product.product')->with(['products'=>$products,'category_id'=>$id]);
    }

    public function create($cat_id)
    {

      $categories = Category::select('id','name','category_type')->where('id',$cat_id)->whereNotNull('parent_id')->first();

        return view('dashboard.product.create')->with(['categories'=>$categories]);
    }

    public function store(CreateProductRequest  $request)
    {

       $product= Product::create($request->except('_token'));

        return redirect()->route('product.index',$product->category_id)->with(['success' => 'product is added successfully']);
    }



    public function edit($product_id)
    {
      $product = Product::with('category')->where('id',$product_id)->first();
        if (!$product)
        {
            return redirect()->back();
        }
      $categories = Category::select('id','name')->whereNotNull('parent_id')->get();

        return view('dashboard.product.edit')->with(['product'=>$product,'categories'=>$categories]);
    }

    public function update($category_id,CreateProductRequest $request)
    {

        $product=Product::findOrfail($category_id);
        $product->update($request->except('_token'));
        return redirect()->route('product.index',$product->category_id)->with('success', 'Category updated successfully');
    }

    public function destroy($product_id)
    {
           $product=Product::findOrfail($product_id);
           $cat_id=$product->category_id;
            $product->delete();

        return redirect()->route('product.index',$cat_id)->with('success', 'product deleted successfully');

    }

}
