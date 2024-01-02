<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class ValidationHelper
{
    public function getValidationErrorsWithRequest(Validator $validator)
    {

        if ($validator->fails()) {

            $messages = $validator->errors();
            $errors   = [];

            foreach ($messages->jsonSerialize() as $field => $msg)
            {
                $errors[] =
                    $msg[0]
                ;
            }
            $errors_array["erorrs"] =$errors;

            return $errors[0];
        }

        return false;
    }

    public function applyValidator(Request $request, array $rules, array $messages)
    {
        return \Validator::make($request->all(), $rules, $messages);
    }

    public function checkIfNotHaveAnError($customValidationForUserBeforeLogin)
    {
        //if There Is No Errors return true;
        if (count($customValidationForUserBeforeLogin) <= 0) {
            return true;
        }

        $errorsMessages = [];
        foreach ($customValidationForUserBeforeLogin as $field => $error) {
            $errorsMessages[] = [
                "field"     => $field,
                "errorCode" => "logic",
                "errorMsg"  => $error
            ];
        }

        return $errorsMessages;
    }

}
