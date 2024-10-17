<?php

namespace App\Http\Controllers;

use App\Models\LinkOtherProcess;
use App\Models\OtherCategories;
use App\Models\otherCurrentAttachments;
use App\Models\otherOldAttachments;
use App\Services\CategoryService;
use DB;
use Illuminate\Http\Request;

class otherApiController extends Controller
{

    public function test(){
        return response('Hello');
    }

    public function showOtherCategories($id,CategoryService $categoryService)
    {
        
        $categories = DB::table('other_categories')->join('link_other_process','other_categories.id','link_other_process.sub_id')
        ->select('other_categories.*', 'link_other_process.id as process-id', 'link_other_process.parent_id as process_parent', 'link_other_process.sub_id as process_sub', 'link_other_process.file_type')
        ->where('other_categories.parent_id',$id)->get();

        $children_type = count($categories) != 0 ? $categories[0]->file_type : null;
        
        // return CategoryService->suceesResponse()
        if($categories){
            return $categoryService->SuccessResponse('success',$categories);
        }
        return $categoryService->ErrorResponse("data not found");


        // return view('dashboard.other.categories.show_other_categories')->with(['categories'=>$categories,'parent_id'=>$id, 'children_type'=>$children_type]);
    }

    public function showAllOldAttachments($id)
    {
        // $link_process = LinkOtherProcess::join('other_old_attachments','link_other_process.sub_id','other_old_attachments.id')->where('parent_id',$sub_id)->where('file_type','old')->get();
        
        
        $attachments = otherOldAttachments::where('product_id',$id)->get();
        
        $grand_parent = LinkOtherProcess::where('sub_id',$id)->select('parent_id')->get();
        
        return view('dashboard.other.attachments.all_other_old_attachments')->with(['attachments'=>$attachments,'parent_id'=>$id,'grand_parent_id'=>$grand_parent]);
    }

    public function showAllCurrentAttachments($id)
    {

        $productsline = otherCurrentAttachments::where('product_line_id',$id)->get();
        $product=OtherCategories::where('id',$id)->first();
        $grand_parent = LinkOtherProcess::where('sub_id',$id)->select('parent_id')->get();

        return view('dashboard.other.attachments.all_other_current_attachments')
        ->with(['attachments'=>$productsline, 'product'=>$product,'parent_id'=>$id,'grand_parent'=>$grand_parent]);

    }
}
