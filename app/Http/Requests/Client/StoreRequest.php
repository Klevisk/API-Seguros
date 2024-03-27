<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
             'name' => 'required|string',
             'email' => 'required',
             'phone' => 'required|string',
             'city' => 'required|string',
             'address' => 'required|string',
             'document' => 'required|min:7|max:16|unique:datos',
            'user_id' => 'required',
        ];
    }

    // public function messages(){
    //     return [
    //         'document.unique' => 'El documento ya existe en la base de datos.',
    //         'document'=> 'El documento ya existe en la base de datos.',
    //     ] ;
    // }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data'    => $validator->errors(),
        ], 400));
    }
}
