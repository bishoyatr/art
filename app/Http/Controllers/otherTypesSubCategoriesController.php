<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Models\OtherCategories;
use App\Models\otherYearTitles;
use App\Models\Type;
use Illuminate\Http\Request;

class otherTypesSubCategoriesController extends Controller
{
    public function showOtherSubCategories($id)
    {
        $categories = OtherCategories::whereNotNull('parent_id')->where('parent_id',$id)->get();
        $parent_category = OtherCategories::where('id',$id)->first();
        $types = Type::all();
        return view('dashboard.other.subCategories.show_other_sub_categories')->with(['categories'=>$categories,'parent_category'=>$parent_category, 'types'=>$types]);
    }

    public function createOtherSubCategory($sub_id)
    {
        $parent_category = OtherCategories::where('id',$sub_id)->first();
        $types = Type::where('id',$parent_category->category_type)->first();
        return view('dashboard.other.subCategories.create_other_sub_category')->with(['types'=>$types,'parent_id'=>$sub_id,'parent_category'=>$parent_category]);
    }

    public function storeOtherSubCategory(CreateCategoryRequest $request)
    {
        $created = OtherCategories::create($request->except('_token'));

        otherYearTitles::insert([[
            'product_id'=>$created->id,
            'title'=>'current',
            'description'=>'...',
            'is_active'=> $created->is_active,
            'type'=>$created->category_type
        ],
        [
            'product_id'=>$created->id,
            'title'=>'old',
            'description'=>'...',
            'is_active'=> $created->is_active,
            'type'=>$created->category_type
        ]
    ]);
        return redirect()->route('otherTypesSubCategories.index',$request->parent_id)->with(['success' => 'category is added successfully']);
    }

    public function editOtherSubCategory($sub_id)
    {
        $category = OtherCategories::find($sub_id);
        $parent_categories = OtherCategories::join('types','other_categories.category_type','=','types.id')
        ->select('other_categories.*','types.id as t_id','types.name as t_name')->whereNull('parent_id')->get();
        $types = Type::where('process',2)->get();
        if (!$category){
            return redirect()->route('otherTypesSubCategories.index')->with('error','هذا القسم غير موجود');
        }
        return view('dashboard.other.subCategories.edit_other_sub_category')->with(['category'=>$category,'types'=>$types,'parent_categories'=>$parent_categories]);
    }

    public function updateOtherSubCategory($sub_category_id,CreateCategoryRequest $request)
    {
        $sub_category = OtherCategories::findOrfail($sub_category_id);
        $checkParent = OtherCategories::find($request->parent_id);
        if($request->category_type != $checkParent->category_type){
            return redirect()->back()->with('error','Category Type Must be The Same as Chosen Type');
        }
        $sub_category->update($request->except('_token'));
        $year_titles = otherYearTitles::where('product_id',$sub_category_id)->get();
        foreach ($year_titles as $year_title )
        {
            $year_title->update(['type'=>$sub_category->category_type,'is_active'=>$sub_category->is_active]);
        }
        return redirect()->route('otherTypesSubCategories.index',$sub_category->parent_id)->with('success', 'Category updated successfully');
    }

    public function deleteOtherSubCategory($sub_category_id)
    {
        $sub_category = OtherCategories::findOrfail($sub_category_id);
        $sub_category->delete();
        otherYearTitles::where('product_id',$sub_category_id)->delete();
        return redirect()->back()->with('success', 'Category deleted successfully');
    }

}
