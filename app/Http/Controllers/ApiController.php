<?php

namespace App\Http\Controllers;

use App\Helpers\ValidationHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;

class ApiController extends BaseController
{
    protected $validator;
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
        public function __construct(Request $request)
    {
            $this->validator      = new ValidationHelper();




    }
}
