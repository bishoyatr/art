<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\ApiController;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoriesController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CategoryService $categoryService)
    {
         $validation=$categoryService->getCategoriesValidation($request);
        $validator_error = $this->validator->getValidationErrorsWithRequest($validation);
        if ($validator_error)
        {
            return $categoryService->ErrorResponse($validator_error);
        }
        $category_type=$request->type_id;
        $categories = Category::GetAllParentCategoriesByCategoryType($category_type);
        $categories_collection=new CategoryCollection($categories);
        if (count($categories_collection))
        {
           return $categoryService->SuccessResponse('success',$categories_collection);
        }
        return $categoryService->ErrorResponse("data not found");
    }
}
