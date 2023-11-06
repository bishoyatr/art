<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
class LoginController extends Controller
{
     public function __construct(CategoryService $categoryService,AuthService $authService)
    {
        $this->categoryService = $categoryService;
        $this->authService = $authService;
    }
    public function index()
    {
       
        $types = config('types');
        $data = [
        'message' => 'This is a JSON response',
        'data' => ['item1', 'item2', 'item3'],
    ];
        return $data;
         
    }


    public function showLoginForm()
    {
        return view('login'); 
    }
    public function logout()
    {
        session()->flush();
        Auth::logout();
        return view('login'); 
    }

    public function log(Request $request)
    {
        
      //  $credentials = $request->only('username', 'password');
        $is_logged = $this->authService->auth($request->username,$request->password);
      
       // $user =  User::find(1);
        if ($is_logged) {
         echo json_encode(['ff'=>'ss']);
        }
         echo json_encode(['ff'=>'ss3']);
         die();
   

        
    }
    
}
