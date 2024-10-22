<?php

namespace App\Http\Controllers;

use App\Models\LinkOtherProcess;
use App\Models\notification;
use App\Models\OtherCategories;
use App\Models\otherCurrentAttachments;
use App\Models\otherOldAttachments;
use DB;
use Illuminate\Http\Request;

class otherApiController extends Controller
{
    private function handleResponse($status,$code,$msg,$data){
        return [
            'status'  => $status,
            'code'    => $code,
            'message' => $msg,
            'data'    => $data
        ];
    }   
    
    public function getCategoriesByTypes($id){
        $categories = OtherCategories::where('category_type',$id)->whereNull('parent_id')->get();
        return response()->json($this->handleResponse('sucess',200,'sucess',$categories));
    }

    public function showOtherCategories($id){
        
        $categories = DB::table('other_categories')->Join('link_other_process','other_categories.id','link_other_process.parent_id')
        ->select('other_categories.id','other_categories.name','other_categories.category_type','other_categories.parent_id','other_categories.is_active', 'link_other_process.id as process-id', 'link_other_process.parent_id as process_parent', 'link_other_process.sub_id as process_sub', 'link_other_process.file_type')
        ->where('other_categories.parent_id',$id)->get();
        
        if($categories){
            return response()->json($this->handleResponse('success',200,'sucess',$categories),200);
        }
        return response()->json($this->handleResponse('success',200,'sucess',$categories),200);
    }

    public function showAllOldAttachments($id)
    {
        $attachments = otherOldAttachments::where('product_id',$id)->get();
        
        // $grand_parent = LinkOtherProcess::where('sub_id',$id)->select('parent_id')->get();
            return response()->json($this->handleResponse('sucess',200,'sucess',$attachments),200);
    }

    public function showAllCurrentAttachments($id)
    {

        $productsline = otherCurrentAttachments::where('product_line_id',$id)->get();
        $product=OtherCategories::where('id',$id)->first();
        $grand_parent = LinkOtherProcess::where('sub_id',$id)->select('parent_id')->get();

        return response()->json($this->handleResponse('sucess',200,'sucess',$productsline),200);
    }

    public function showSingleCurrentAttachment($id)
    {
        $history= otherCurrentAttachments::findOrfail($id);
        $images=json_decode($history->images);

        // $data = $history->merge($images);
        return response()->json($this->handleResponse('sucess',200,'sucess',$history),200);
    }

    public function showSingleOldAttachment($id)
    {
        $history= otherOldAttachments::findOrfail($id);
        $images=json_decode($history->images);
        return response()->json($this->handleResponse('sucess',200,'sucess',$history),200);
    }
}
