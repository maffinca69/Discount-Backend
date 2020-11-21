<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $error = $validator->errors()->first();
        throw new HttpResponseException(
            response()->json(
                [
                    'status' => false,
                    'message' => $error
                ],
                422
            )
        );
    }
}
