<?php
namespace App\Http\Controllers\Admin;

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
class LoginController extends Controller
{
     public function __construct(CategoryService $categoryService,AuthService $authService)
    {
        $this->categoryService = $categoryService;
        $this->authService = $authService;
    }
    public function index()
    {
        $css = 'general';
        $js = 'general';
        $types = config('types');
      //  dd(auth()->id());
      /*  $catgegories = $this->categoryService->mainCategories() ;
            $cat = CategoryResource::collection($catgegories);
            dd($cat);
        foreach($catgegories as $cat)
        {
            foreach($cat->products as $p)
        {
                foreach($p->productLines as $pl)
                {
                    $type = '0' ;
                    $data = $pl->data('0');
                    //$s = new ProductLineData('0');
                 //   $data = $s::all();
                   // $data1 = ProductLineDataResource::collection($data);
                    $res = new ProductLineDataResource($data);
                    dd( $res);
                    dd($data1);
                    
                }
        }
        }*/
        return view('admin.index',get_defined_vars()); 
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
       // Auth::loginUsingId($user->id,true);
        return redirect()->route('dashboard'); 
        }
   

        // Authentication failed
        return back()->withErrors(['username' => 'Invalid credentials'])->withInput();
    }
    
}
