<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;
use DB;

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
      $types = Type::find($categories->category_type);
      return view('dashboard.product.create')->with(['categories'=>$categories, 'types'=>$types]);
    }

    public function store(CreateProductRequest $request)
    {
      $product= Product::create($request->except('_token'));
      return redirect()->route('product.index',$product->category_id)->with(['success' => 'product is added successfully']);
    }

    public function edit($product_id)
    {
      $product = Product::with('category')->where('id',$product_id)->first();
      if (!$product){
        return redirect()->back();
      }
      $sub_categories = DB::table('categories')
        ->join('types','categories.category_type','=','types.id')
        ->selectRaw('categories.id as cat_id, categories.name as cat_name, categories.parent_id, categories.is_active as cat_is_active, category_type, types.id as type_id, types.name as type_name')
        ->whereNotNull('parent_id')
        ->get();

      // $categories = Category::select('id','name')->whereNotNull('parent_id')->get();
      return view('dashboard.product.edit')->with(['product'=>$product, 'sub_categories' =>$sub_categories]);
    }

    public function update($category_id,CreateProductRequest $request)
    {
      $product=Product::findOrfail($category_id);
      $product_sub_category = Category::where('id',$request->category_id)->first();
      $product_parent_category = Category::where('parent_id',$product_sub_category->parent_id)->first();
      if($product_parent_category->category_type != $request->product_status || $product_sub_category->category_type != $request->product_status){
        return redirect()->route('product.edit',$product->id)->with('error', 'Category Type is not the same as the selected type');
      }
      $product->update($request->except('_token'));
      return redirect()->route('product.index',$product->category_id)->with('success', "Successfully Updated");
    }

    public function destroy($product_id)
    {
           $product=Product::findOrfail($product_id);
           $cat_id=$product->category_id;
            $product->delete();

        return redirect()->route('product.index',$cat_id)->with('success', 'product deleted successfully');

    }

}
