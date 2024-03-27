<?php

namespace App\Http\Requests\Family;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'=> 'sometimes|required',
            'document'=> 'sometimes|required',
            'city'=> 'sometimes|required|string',
            'phone'=> 'sometimes|required',
            'address'=> 'sometimes|required',
            'email'=> 'sometimes|required',
            'client_id'=> 'sometimes|required',
            'relationship'=> 'sometimes|required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data'    => $validator->errors(),
        ], 400));
    }

}
