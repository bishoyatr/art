<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
class AuthService
{

    private User $user;

    public function __construct()
    {
        $this->user = new user();
    }
    public function auth($username,$password)
    {
        return Auth::validate(['username' => $username, 'password' => $password]);
    }

}
