<?php
namespace App\Services;

use App\Helpers\MassageHandeler;
use App\Helpers\MessageHandleHelper;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsService
{


    public function __construct()
    {

    }

    public static function SuccessResponse($massage,$data)
    {

       return MassageHandeler::getJsonSuccessResponse($massage,200,$data);
    }
    public static function ErrorResponse($massage="",$data=[])
    {
       return MassageHandeler::getJsonErrorResponse($massage,400,$data);
    }
    public static function getProductsByCategoryIdValidation(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        $messages =
            [
              "category_id.required"=>"category id is required",
              "category_id.integer"=>"category id must be integer",
              "type_id.required"=>"type id is required",
              "type_id.integer"=>"type id must be integer",
              "is_current.required"=>"is current is required",
              "is_current.integer"=>"is current must be integer",
            ];

        $rules =
            [
              "category_id" => "required|integer",
              "type_id" => "required|integer",
              "is_current" => "required|integer"
            ];

        return Validator::make($request->all(), $rules, $messages);
    }
    public static function loginValidation(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        $messages =
            [
            "user_name.required"=>"user name id is required",
            "password.required"=>"password  is required"
            ];

        $rules = [
            "user_name" => "required|string",
            "password" => "required"
        ];

        return Validator::make($request->all(), $rules, $messages);
    }
    public static function updateImageValidation(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        $messages =
            [
            "image.required"=>"image is required",
            "image.image"=>"image  is required image"
            ];

        $rules = [
            'image' => "required|image|mimes:jpeg,png,jpg,gif,svg",

        ];

        return Validator::make($request->all(), $rules, $messages);
    }
    public static function getProductLinesByProductIdValidation(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        $messages =
            [
            "product_id.required"=>"product id is required",
            "product_id.integer"=>"product id must be integer",
            "type_id.required"=>"type id is required",
            "type_id.integer"=>"type id must be integer",
            ];

        $rules = [
            "product_id" => "required|integer",
            "type_id" => "required|integer"
        ];

        return Validator::make($request->all(), $rules, $messages);
    }
    public static function getCurrentProductAttachmentValidation(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        $messages =
            [
            "product_line_id.required"=>"product id is required",
            "product_line_id.integer"=>"product id must be integer",
            "type_id.required"=>"type id is required",
            "type_id.integer"=>"type id must be integer",
            ];

        $rules = [
            "product_line_id" => "required|integer",
            "type_id" => "required|integer"
        ];

        return Validator::make($request->all(), $rules, $messages);
    }
    public static function productHistoryTransformer($year_title,$history_attachments)
    {
      $data=[];
      $data['year_title']=$year_title->title;
      $data['year_description']=$year_title->description;
      foreach ($history_attachments as $history_attachment)
      {
          $alpoum=[];
          foreach (json_decode($history_attachment->images) as $key=>$image)
          {
              $alpoum[]=[
                         'id'=>$key,
                         'image'=>asset("assets/images/").'/'.$image
                        ];
          }
          $data['history'][]=[
                              'id'=>$history_attachment->id,
                              'title'=>$history_attachment->title,
                              'youtube'=>$history_attachment->youtube ?? '',
                              'album'=>$alpoum,
                             ];
      }
      return $data;
    }





    // Add other methods related to categories here
}
