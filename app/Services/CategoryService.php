<?php
namespace App\Services;

use App\Helpers\MassageHandeler;
use App\Helpers\MessageHandleHelper;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryService
{

    private Category $car;


    public function __construct()
    {
        $this->category = new Category();
    }
    public function mainCategories()
    {
       return $this->category::whereNull('parent_id')->where('is_active',1)->get();
    }
    public function SuccessResponse($massage,$data)
    {

       return MassageHandeler::getJsonSuccessResponse($massage,200,$data);
    }
    public function ErrorResponse($massage="",$data=[])
    {
       return MassageHandeler::getJsonErrorResponse($massage,400,$data);
    }
    public function getSubCategoriesValidation(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        $messages = [

            "parent_id.required"=>"parent id is required",
            "type_id.required"=>"type id is required",
            "parent_id.integer"=>"parent id must be integer",
            "type_id.integer"=>"type id must be integer"
        ];

        $rules = [
            "parent_id" => "required|integer",
            "type_id" => "required|integer"
        ];

        return Validator::make($request->all(), $rules, $messages);
    }
    public function getCategoriesValidation(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        $messages = [

            "type_id.required"=>"type id is required",
            "type_id.integer"=>"type id must be integer"
        ];

        $rules = [
            "type_id" => "required|integer"
        ];

        return Validator::make($request->all(), $rules, $messages);
    }




    // Add other methods related to categories here
}
