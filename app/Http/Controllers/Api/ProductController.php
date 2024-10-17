<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsCollection;
use App\Models\Product;
use App\Services\ProductsService;
use Illuminate\Http\Request;

class ProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validation=ProductsService::getProductsByCategoryIdValidation($request);
        $validator_error = $this->validator->getValidationErrorsWithRequest($validation);
        if($validator_error)
        {
            return ProductsService::ErrorResponse($validator_error);
        }
        $products_status=$request->type_id;
        $packaging_status=$request->is_current;
        $category_id=$request->category_id;
        $products= Product::getAllProductsByCategoryId($category_id,$products_status,$packaging_status);

        $products_collection=new ProductsCollection($products);
        if (count($products_collection))
        {
            return ProductsService::SuccessResponse('success',$products_collection);
        }
        return ProductsService::ErrorResponse("data not founddd");
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
