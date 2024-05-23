<?php

namespace App\Http\Controllers\Api;

use App\Helpers\MassageHandeler;
use App\Models\Type;

class TypeController
{


    public function index()
    {
        return MassageHandeler::getJsonSuccessResponse("Successful",200,Type::all());

    }
}
