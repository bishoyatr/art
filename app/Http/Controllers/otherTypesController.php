<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Models\LinkOtherProcess;
use App\Models\OtherCategories;
use App\Models\Type;
use DB;
class otherTypesController extends Controller
{
    public function showOtherCategories($id)
    {
        
        $categories = DB::table('other_categories')->join('link_other_process','other_categories.id','link_other_process.sub_id')
        ->select('other_categories.*', 'link_other_process.id as process-id', 'link_other_process.parent_id as process_parent', 'link_other_process.sub_id as process_sub', 'link_other_process.file_type')
        ->where('other_categories.parent_id',$id)->get();

        $children_type = count($categories) != 0 ? $categories[0]->file_type : null;
        
        return view('dashboard.other.categories.show_other_categories')->with(['categories'=>$categories,'parent_id'=>$id, 'children_type'=>$children_type]);
    }

    public function createOtherCategory($id)
    {
        $parent = OtherCategories::find($id);
        // $types = Type::where('process','=',2)->get();
        return view('dashboard.other.categories.create_other_category')->with(['parent_id'=>$id,'parent'=>$parent]);
    }

    public function storeOtherCategory($id,CreateCategoryRequest $request)
    {
        $create = OtherCategories::create($request->except('_token'));
        LinkOtherProcess::create([
            'parent_id'=> $id,
            'sub_id' => $create->id,
            'file_type' => 'folder'
        ]);
        return redirect()->route('otherCategories.index',$id)->with(['success' => 'category is added successfully']);
    }

    public function editOtherCategory($category_id)
    {
        $category = OtherCategories::find($category_id);
        $grand_parents = null;
        if(!$category)
        {
            return redirect()->route('category.index')->with('error','هذا القسم غير موجود');
        }
        
        if($category->parent_id == null){
            $grand_parents = Type::where('process',2)->get();
        }else{
            $types_parent = LinkOtherProcess::where('sub_id',$category->parent_id)->select('id','parent_id')->first();
            $grand_parents = OtherCategories::join('link_other_process','other_categories.id','=','link_other_process.sub_id')
            ->select('other_categories.*','link_other_process.id as link_id','link_other_process.parent_id as link_parent','link_other_process.sub_id as link_sub','link_other_process.file_type')
            ->where('other_categories.parent_id',$types_parent->parent_id)
            ->get();

        }
        return view('dashboard.other.categories.edit_other_categories')->with(['category'=>$category,'grand_parents'=>$grand_parents]);
    }

    public function updateOtherCategory($category_id,CreateCategoryRequest $request)
    {
        $category=OtherCategories::findOrfail($category_id);
        $category->update($request->except('_token'));
        LinkOtherProcess::where('sub_id',$category->id)->update(['parent_id'=>$category->parent_id]);
        
        if($category->parent_id == 0){
            return redirect()->route('category.index')->with('success', 'Category updated successfully');    
        }
        
        return redirect()->route('otherCategories.index',$category->parent_id)->with('success', 'Category updated successfully');
    }

    public function deleteOtherCategory($category_id)
    {
        $category=OtherCategories::findOrfail($category_id);
        $category->delete();
        // $sub_category=Category::where('parent_id',$category_id)->delete();
        if($category->parent_id == 0){
            return redirect()->route('category.index')->with('success', 'Category deleted successfully');
        
        }
        return redirect()->route('otherCategories.index',$category->parent_id)->with('success', 'Category deleted successfully');
    }
    
}
