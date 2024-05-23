<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductsService;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\ProductLineData;
use Illuminate\Support\Facades\Auth;
use App\Services\CategoryService;
use App\Services\AuthService;
use App\Http\Resources\ProductLineDataResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
class LoginController extends Controller
{
     public function __construct(CategoryService $categoryService,AuthService $authService)
    {
        $this->categoryService = $categoryService;
        $this->authService = $authService;
    }
    public function login(Request $request)
    {

        $validation=ProductsService::loginValidation($request);

        if (count($validation->errors()))
           {
              return ProductsService::ErrorResponse("input names are not correct i must recive user_name , password");
           }
        $apiEndpoint = 'https://sales.atr-eg.com/api/auth_user_for_art.php';
        $post_data= array(
             'user_name' => $request->user_name,
             "user_password"=>$request->password
             );
        $ch = curl_init($apiEndpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string instead of outputting it directly
        curl_setopt($ch, CURLOPT_POST, true); // Set the request method to POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data); // Set the POST data
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $res = curl_exec($ch) ;

        if ($res === false) {
         return ProductsService::ErrorResponse("server error");
        }
        $response = json_decode($res);
        if(isset($response->status) && $response->status=="success")
        {
           $user=User::where('name',$request->user_name)
               ->where('password',$request->password)
               ->first();
           if(!$user)
           {
             $user=User::create(
                 [
                 'name'=>$request->user_name,
                 'password'=>$request->password,
                 'avatar'=>'product_line/default.png',
                 ]
             );
             $tokenStr = $user->createToken('remember_token')->accessToken;
             $user->remember_token=$tokenStr->token;
             $user->save();
                            $token= (object)
                            [
                                'token'=>$user->remember_token,
                                'name'=>$user->name,
                                'is_active'=>$user->is_active,
                                'pdf_allowed'=>$user->pdf_allowed,
                                'image'=>asset("assets/images/").'/'.$user->avatar,
                                "upload_apple_version"=>'true'
                            ];

             return ProductsService::SuccessResponse('success',$token);

           }
           else
           {
                $token= (object)
                [
                    'token'=>$user->remember_token,
                    'name'=>$user->name,
                    'is_active'=>$user->is_active,
                    'pdf_allowed'=>$user->pdf_allowed,
                    'image'=>asset("assets/images/").'/'.$user->avatar,
                    "upload_apple_version"=>'true'
                ];
               return ProductsService::SuccessResponse('success',$token);
           }

        }
    return ProductsService::ErrorResponse("user not authorized");


    }


    public function updateImage(Request $request)
    {
            $validation=ProductsService::updateImageValidation($request);

        if (count($validation->errors()))
           {
              return ProductsService::ErrorResponse("image is required");
           }
          $fileName = uploadImage('product_line', $request->image);
          $request->request->add(['avatar' => $fileName]);
         $user_login=User::where('remember_token',$request->header('token'))->first();
         $user_login->avatar = $fileName;
        $user_login->save();
                      $token= (object)
                      [
                          'token'=>$user_login->remember_token,
                          'name'=>$user_login->name,
                          'image'=>asset("assets/images/").'/'.$user_login->avatar
                      ];
             return ProductsService::SuccessResponse('success',$token);

    }




}
