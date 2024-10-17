<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductLineRequest;
use App\Http\Requests\CurrentAttatchmentRequest;
use App\Http\Requests\UpdateAttatchmentRequest;
use App\Models\CurrentProductLineAttatchment;
use App\Models\Product;
use App\Models\Product_line;
use App\Models\Type;


class ProductLineController extends Controller
{
    public function index($product_id,$type=null)
    {
        $productsline = Product_line::where('product_id',$product_id)
            ->with('product')->get();
        $product=Product::where('id',$product_id)->first();

        return view('dashboard.productline.productline')
        ->with(['products_lines'=>$productsline, 'product'=>$product]);
    }

    public function create($prouct_id,$type=null)
    {
        $products = Product::select('id','name','product_status')->where('id',$prouct_id)->first();
        return view('dashboard.productline.create')->with(['product'=>$products,'type'=>$type]);
    }

    public function store(CreateProductLineRequest $request)
    {
        $product_line=Product_line::create($request->except('_token'));
        return redirect()->route('productline.index',[$product_line->product_id,$product_line->product_line_status])
            ->with(['success' => 'product is added successfully']);
    }

    public function edit($product_line_id)
    {
        $product_line = Product_line::with('product')->where('id',$product_line_id)->first();
        $types = Type::all();
        
        if (!$product_line)
        {
            return redirect()->route('productlinen.index')->with('error','No Data found');
        }
        $products = Product::select('id','name','product_status')->get();

        return view('dashboard.productline.edit')->with(['product_line'=>$product_line,'products'=>$products,'type'=>$types]);      
    }

    public function update($product_line_id,CreateProductLineRequest $request)
    {

        $product=Product_line::findOrfail($product_line_id);
        $newProduct = Product::find($request->product_id);
        if($request->product_line_status != $newProduct->product_status ){
            return redirect()->route('productline.edit',$product_line_id)->with('error', 'Category Type Must be the same as chosen Type');

        }
        $product->update($request->except('_token'));
        return redirect()->route('productline.index',[$product->product_id,$product->product_line_status])->with('success', 'Category updated successfully');
    }

    public function destroy($product_line_id)
    {
           $product_line=Product_line::findOrfail($product_line_id);

            $product_line->delete();

        return redirect()->back()->with('success', 'product deleted successfully');

    }
    public function deleteCurrentAttachment($product_line_id)
    {
           $product_line=CurrentProductLineAttatchment::findOrfail($product_line_id);

            $product_line->delete();

        return redirect()->back()->with('success', 'product deleted successfully');

    }
    public function AddOrEditAttachment ($product_line_id)
    {
        $product_line=Product_line::findOrfail($product_line_id);
        return view('dashboard.productline.add_or_edit_current_attachment')->with(['product_line'=>$product_line]);


    }
    public function StoreOrEditAttachment (CurrentAttatchmentRequest $request)
    {
     if($request->has('id'))
       {
           $category=CurrentProductLineAttatchment::findOrfail($request->id);
       if($request->has('photo'))
        {
            $this->mapImage($request);

        }
        if($request->has('pdf_file'))
        {
         $pdf_name = uploadImage('product_line', $request->pdf_file);
         $request->request->add(['pdf' => $pdf_name]);

        }
        $category->update($request->except(['_token','photo','pdf_file']));
         return redirect()->back()->with('success', 'product deleted successfully');
       }
        $product_line=Product_line::findOrfail($request->product_line_id);
        if($request->has('photo'))
        {
           $this->mapImage($request);
        }
        if($request->has('pdf_file'))
        {
         $pdf_name = uploadImage('product_line', $request->pdf_file);
         $request->request->add(['pdf' => $pdf_name]);

        }

        $product_line_attatchment=CurrentProductLineAttatchment::updateOrCreate
        (['product_line_id'=>$request->product_line_id,'product_line_attachment_status'=>$request->product_line_attachment_status,],$request->except
        (['_token','photo','pdf_file']));
           return redirect()->route('productline.index',[$product_line->product_id,$product_line->product_line_status])->with('success', 'product data added successfully');
    }
    
     public function updateAttachment (UpdateAttatchmentRequest $request)
    {
     if($request->has('id'))
       {
           $category=CurrentProductLineAttatchment::findOrfail($request->id);
       if($request->has('photo'))
        {
            $this->mapImage($request);

        }
        if($request->has('pdf_file'))
        {
         $pdf_name = uploadImage('product_line', $request->pdf_file);
         $request->request->add(['pdf' => $pdf_name]);

        }
        $category->update($request->except(['_token','photo','pdf_file']));
         return redirect()->back()->with('success', 'product deleted successfully');
       }
        $product_line=Product_line::findOrfail($request->product_line_id);
        if($request->has('photo'))
        {
            $this->mapImage($request);

        }
        if($request->has('pdf_file'))
        {
         $pdf_name = uploadImage('product_line', $request->pdf_file);
         $request->request->add(['pdf' => $pdf_name]);

        }

        $product_line_attatchment=CurrentProductLineAttatchment::updateOrCreate
        (['product_line_id'=>$request->product_line_id,'product_line_attachment_status'=>$request->product_line_attachment_status,],$request->except
        (['_token','photo','pdf_file']));
           return redirect()->route('productline.index',[$product_line->product_id,$product_line->product_line_status])->with('success', 'product data added successfully');
    }
    public function ShowCurrentAttachment ($product_line_id)
    {
        $product_line_attatchment=CurrentProductLineAttatchment::where('product_line_id',$product_line_id)->get();
        if (!$product_line_attatchment)
        {
         return redirect()->back()->with('error','No Data found');

        }
        return view('dashboard.productline.current_attachment')
               ->with(['product_lines'=>$product_line_attatchment,]);
    }


    private function mapImage($request)
    {
        $images=[];
        foreach ($request->photo as $photo){
            $fileName = uploadImage('product_line', $photo);
            $request->request->add(['image' => $fileName]);
            $images[]=$fileName;
        }
        $images=json_encode($images);
        $request->request->add(['image' => $images]);
    }

}
