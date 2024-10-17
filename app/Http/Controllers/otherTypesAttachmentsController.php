<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrentAttatchmentRequest;
use App\Http\Requests\UpdateAttatchmentRequest;
use App\Http\Requests\UpdateProuctHistoryAttachment;
use App\Models\LinkOtherProcess;
use App\Models\OtherCategories;
use App\Models\otherCurrentAttachments;
use App\Models\Type;
use App\Models\otherOldAttachments;
use App\Http\Requests\ProuctHistoryAttachment;

use Illuminate\Http\Request;

class otherTypesAttachmentsController extends Controller
{

    public function showAllOldAttachments($id)
    {
        // $link_process = LinkOtherProcess::join('other_old_attachments','link_other_process.sub_id','other_old_attachments.id')->where('parent_id',$sub_id)->where('file_type','old')->get();
        
        
        $attachments = otherOldAttachments::where('product_id',$id)->get();
        
        $grand_parent = LinkOtherProcess::where('sub_id',$id)->select('parent_id')->get();
        
        return view('dashboard.other.attachments.all_other_old_attachments')->with(['attachments'=>$attachments,'parent_id'=>$id,'grand_parent_id'=>$grand_parent]);
    }

    public function createOldAttachment($sub_id)
    {
        $parent_category = OtherCategories::where('id',$sub_id)->first();
        $types = Type::where('id',$parent_category->category_typex)->first();
        return view('dashboard.other.attachments.add_other_old_attachment')->with(['types'=>$types,'parent_id'=>$sub_id,'parent_category'=>$parent_category]);
    }

    public function storeOldAttachment(ProuctHistoryAttachment $request)
    {
        $images=[];
        foreach ($request->history_images as $image)
        {
          $fileName = uploadImage('product_line', $image);
           $images[]=$fileName;
        }
        $images=json_encode($images);
         $request->request->add(['images' => $images]);
        $created = otherOldAttachments::create($request->except(['_token','history_images']));
        LinkOtherProcess::create([
            'parent_id'=> $created->product_id,
            'sub_id'=>$created->id,
            'file_type' => 'old'
        ]);
        return redirect()->route('otherOldAttachments.index',$request->product_id)->with('تم الاضافة بنجاح ');
    }

    public function editOldAttachment($id)
    {
        $attachment= otherOldAttachments::findOrfail($id);
        return view('dashboard.other.attachments.edit_other_old_attachment')->with(['history'=>$attachment]);

    }

    public function updateOldAttachment(UpdateProuctHistoryAttachment $request)
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
         otherOldAttachments::where('id', $request->history_id)->update($request->except(['_token','history_images','history_id']));
          return redirect()->route('otherOldAttachments.index',$request->product_id)->with('تم التحديث بنجاح ');

    }

    public function showOldAttachment($id)
    {
        $history= otherOldAttachments::findOrfail($id);
        $images=json_decode($history->images);
        return view('dashboard.other.attachments.single_other_old_attachment')->with(['history'=>$history,'images'=>$images]);
    }

    public function deleteOldAttachment($id)
    {
        $history= otherOldAttachments::findOrfail($id);
        // $product_id=$history->product_id;
        // $type=$history->type;
        $history->delete();

          return redirect()->route('otherOldAttachments.index',$history->product_id)->with('تم الحذف بنجاح ');

    }


    //Current Methods


    public function showAllCurrentAttachments($id)
    {

        $productsline = otherCurrentAttachments::where('product_line_id',$id)->get();
        $product=OtherCategories::where('id',$id)->first();
        $grand_parent = LinkOtherProcess::where('sub_id',$id)->select('parent_id')->get();

        return view('dashboard.other.attachments.all_other_current_attachments')
        ->with(['attachments'=>$productsline, 'product'=>$product,'parent_id'=>$id,'grand_parent'=>$grand_parent]);

        // $attachments = otherCurrentAttachments::where('product_line_id',$id)->get();
        // return view('dashboard.other.attachments.all_other_current_attachments')->with(['attachments'=>$attachments,'parent_id'=>$id]);
    }

    public function createCurrentAttachment($sub_id)
    {
        $parent_category = OtherCategories::where('id',$sub_id)->first();
        $types = Type::where('id',$parent_category->category_type)->first();
        return view('dashboard.other.attachments.add_other_current_attachment')->with(['types'=>$types,'parent_id'=>$sub_id,'parent_category'=>$parent_category]);
    }

    public function storeCurrentAttachment(CurrentAttatchmentRequest $request)
    {
        if($request->has('photo')){
            $this->mapImage($request);
        }
         if($request->has('pdf_file')){
          $pdf_name = uploadImage('product_line', $request->pdf_file);
          $request->request->add(['pdf' => $pdf_name]);
        }
        $create = otherCurrentAttachments::updateOrCreate(['product_line_id'=>$request->product_line_id,'product_line_attachment_status'=>$request->product_line_attachment_status,],$request->except
        (['_token','photo','pdf_file']));

        LinkOtherProcess::create([
            'sub_id' => $create->id,
            'parent_id' => $create->product_line_id,
            'file_type'=>'current'
        ]);


        return redirect()->route('otherCurrentAttachments.index',$request->product_line_id)->with('success', 'product data added successfully');
    }

    public function editCurrentAttachment($id)
    {
        $product_line=otherCurrentAttachments::findOrfail($id);
        return view('dashboard.other.attachments.edit_other_current_attachment')->with(['product_line'=>$product_line]);

    }


    public function updateCurrentAttachment($id , UpdateAttatchmentRequest $request)
    {

        $category=otherCurrentAttachments::findOrfail($id);
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
 
        
        return redirect()->route('otherCurrentAttachments.index',$request->id)->with('success', 'product Updated successfully');
    }

    public function showCurrentAttachment($id)
    {
        $history= otherCurrentAttachments::findOrfail($id);
        $images=json_decode($history->images);
        return view('dashboard.other.attachments.single_other_Current_attachment')->with(['product_line'=>$history,'images'=>$images]);
    }

    public function deleteCurrentAttachment($id)
    {
        $history= otherCurrentAttachments::findOrfail($id);
        // $product_id=$history->product_id;
        // $type=$history->type;
        $history->delete();

          return redirect()->route('otherCurrentAttachments.index',$history->product_line_id)->with('تم الحذف بنجاح ');

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
