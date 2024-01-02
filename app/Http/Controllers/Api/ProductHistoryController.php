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
use App\Models\ProductHistoryAttchment;
use App\Models\ProductYearTitle;
use App\Services\ProductsService;
use Illuminate\Http\Request;

class ProductHistoryController extends ApiController
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
         $type=$request->type_id;
         $product_id=$request->product_id;
         $year_title= ProductYearTitle::getAllProductYearTitleByProductId($product_id,$type);
         $history_attachment= ProductHistoryAttchment::getProductHistoryAttchment($product_id,$type);
         if (!$year_title||!$history_attachment)
         {
            return ProductsService::ErrorResponse("data not found");
         }
         $history_transformer= (object) ProductsService::productHistoryTransformer($year_title,$history_attachment);
         return ProductsService::SuccessResponse('success',$history_transformer);




    }

}
