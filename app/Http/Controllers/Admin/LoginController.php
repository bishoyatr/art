<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        return view('dashboard.auth.login');

    }

    public function postLogin(AdminLoginRequest $request)
    {
        $remember_me = ($request->has('remember_me')) ? true : false;

        if ($this->getguard()->attempt(
            [
                'email' => $request->email,
                'password' =>  $request->password,
            ])) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->with(['error' => 'هناك خطأ في البينات']);
        }

    }

    public function logout()
    {
        $guard=$this->getguard();
        $guard->logout();
        return redirect()->route('adminLogin');
    }
    private function getguard()
    {
        return auth()->guard('admin');
    }
}
