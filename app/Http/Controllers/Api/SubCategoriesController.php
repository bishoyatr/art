<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class SubCategoriesController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,CategoryService $categoryService)
    {
        $validation=$categoryService->getSubCategoriesValidation($request);
        $validator_error = $this->validator->getValidationErrorsWithRequest($validation);
        if ($validator_error)
        {
            return $categoryService->ErrorResponse($validator_error);
        }
        $parent_id=$request->parent_id;
        $category_type=$request->type_id;
        $categories = Category::GetAllSubCategoriesByParentIdAndCategoryType($parent_id,$category_type);
        $categories_collection= CategoryCollection::make($categories);
        if (count($categories_collection))
        {
           return $categoryService->SuccessResponse('success',$categories_collection);
        }
        return $categoryService->ErrorResponse("data not found");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
