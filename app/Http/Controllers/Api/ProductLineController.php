<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Product;
use App\Http\Controllers\ProductsCollection;
use App\Http\Resources\ProductLineCurrentDataCollection;
use App\Http\Resources\ProductLinesCollection;
use App\Models\CurrentProductLineAttatchment;
use App\Models\Product_line;
use App\Services\ProductsService;
use Illuminate\Http\Request;

class ProductLineController extends ApiController
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validation=ProductsService::getProductLinesByProductIdValidation($request);
        $validator_error = $this->validator->getValidationErrorsWithRequest($validation);
        if ($validator_error)
           {
              return ProductsService::ErrorResponse($validator_error);
           }
         $products_line_status=$request->type_id;
         $product_id=$request->product_id;
        $product_ines= Product_line::getAllProductLinesByProductId($product_id,$products_line_status);
        $product_lines_collection=new ProductLinesCollection($product_ines);
        if (count($product_lines_collection))
        {
           return ProductsService::SuccessResponse('success',$product_lines_collection);
        }
        return ProductsService::ErrorResponse("data not found");
    }
    public function CurrentProductAttachment(Request $request)
    {
        $validation=ProductsService::getCurrentProductAttachmentValidation($request);
        $validator_error = $this->validator->getValidationErrorsWithRequest($validation);
        if ($validator_error)
           {
              return ProductsService::ErrorResponse($validator_error);
           }
         $products_line_status=$request->type_id;
         $product_id=$request->product_line_id;
        $product_ines= CurrentProductLineAttatchment::getCurrentProductAttachmentByProductId($product_id,$products_line_status);
        $product_lines_collection=new ProductLineCurrentDataCollection($product_ines);
        if (count($product_lines_collection))
        {
           return ProductsService::SuccessResponse('success',$product_lines_collection);
        }
        return ProductsService::ErrorResponse("data not found");
    }
}
