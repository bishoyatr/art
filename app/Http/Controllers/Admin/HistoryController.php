<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductYearTitleRequest;
use App\Http\Requests\ProuctHistoryAttachment;
use App\Http\Requests\UpdateProuctHistoryAttachment;
use App\Models\Product;
use App\Models\Type;
use App\Models\ProductHistoryAttchment;
use App\Models\ProductYearTitle;
use Request;

class HistoryController extends Controller
{
    public function index($product_id)
    {
      $products=ProductYearTitle::where('product_id',$product_id)->get();
      return view('dashboard.history.history')->with(['products'=>$products,'product_id'=>$product_id]);
    }

    public function create($product_id)
    {
      $product = Product::find($product_id);
      $types = Type::find($product->product_status);

      return view('dashboard.history.create')->with(['product_id'=>$product_id,'product'=>$product,'types'=>$types]);
    }
    public function edit($product_id)
    {
      $year_title = ProductYearTitle::find($product_id);
      $type = Type::find($year_title->type);
      return view('dashboard.history.edit')->with(['year_title'=>$year_title, 'type'=>$type]);
    }
    public function update($product_id, ProductYearTitleRequest $request)
    {
      ProductYearTitle::where('id',$product_id)->update([
        'title'=>$request->title,
        'is_active'=>$request->is_active,
        'type'=>$request->type
      ]);
      $products=ProductYearTitle::where('id',$product_id)->first();

      return redirect()->route('history.index',[$products->product_id])->with(['products'=>$products,'product_id'=>$product_id]);
    }

    public function store(ProductYearTitleRequest $request)
    {
        $products=ProductYearTitle::updateOrCreate(
        [
        'product_id'=>$request->product_id,
        'type'=>$request->type
      ],
      $request->except(['_token']));
      return redirect()->route('history.index',[$request->product_id])->with(['success' => 'product is added successfully']);
    }
    public function deleteYeartitle($year_id,$type=null)
    {
            $year_title=ProductYearTitle::findOrfail($year_id);
            $year_title_attachment=ProductHistoryAttchment::where('product_id',$year_title->product_id)
                ->where('type',$type)
                ->first();
            if($year_title_attachment)
            {
                 $year_title_attachment->delete();

            }
                $year_title->delete();

            return redirect()->back()->with(['success' => 'product Deleted successfully']);
    }
    public function historyAttachment($product_id,$type=null)
    {
      $product_history= ProductHistoryAttchment::where('product_id',$product_id)->where('type',$type)->get();
       return view('dashboard.history.product_history_attachments')
             ->with(['product_history_attachments'=>$product_history,'product_id'=>$product_id,'type'=>$type]);
    }
    public function createHistoryAttachment($product_id,$type=null)
    {
         return view('dashboard.history.create_history_attachment')
                ->with(['product_id'=>$product_id,'type'=>$type]);
;
      $product_history= ProductHistoryAttchment::where('product_id',$product_id)->where('type',$type)->get();
       return view('dashboard.history.product_history_attachments')
             ->with(['product_history_attachments'=>$product_history,'product_id'=>$product_id,'type'=>$type]);
    }
    public function storeHistoryAttachment(ProuctHistoryAttachment $request)
    {
        $images=[];
        foreach ($request->history_images as $image)
        {
          $fileName = uploadImage('product_line', $image);
           $images[]=$fileName;
        }
        $images=json_encode($images);
         $request->request->add(['images' => $images]);
         ProductHistoryAttchment::create($request->except(['_token','history_images']));
          return redirect()->route('history.add_history_attachment',[$request->product_id,$request->type])->with('تم الاضافة بنجاح ');

    }
    public function editHistoryAttachment($id)
    {
       $history= ProductHistoryAttchment::findOrfail($id);
        return view('dashboard.history.edit_history_attachment')->with(['history'=>$history]);

    }
    public function updateHistoryAttachment(UpdateProuctHistoryAttachment $request)
    {

        if ($request->has('history_images'))
        {
              $images=[];
        foreach ($request->history_images as $image)
        {
          $fileName = uploadImage('product_line', $image);
           $images[]=$fileName;
        }
        $images=json_encode($images);
         $request->request->add(['images' => $images]);

        }
         ProductHistoryAttchment::where('id', $request->history_id)->update($request->except(['_token','history_images','history_id']));
          return redirect()->route('history.add_history_attachment',[$request->product_id,$request->type])->with('تم التحديث بنجاح ');

    }
    public function showHistoryAttachment($id)
    {
        $history= ProductHistoryAttchment::findOrfail($id);
        $images=json_decode($history->images);
        return view('dashboard.history.show_product_history_attachment')->with(['history'=>$history,'images'=>$images]);

    }
    public function deleteHistoryAttachment($id)
    {
        $history= ProductHistoryAttchment::findOrfail($id);
        $product_id=$history->product_id;
        $type=$history->type;
        $history->delete();

          return redirect()->route('history.add_history_attachment',[$product_id,$type])->with('تم الحذف بنجاح ');

    }
}
