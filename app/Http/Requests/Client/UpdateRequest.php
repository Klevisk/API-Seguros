<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
             'name' => 'sometimes|string',
             'email' => 'sometimes|email',
             'phone' => 'sometimes|string',
             'city' => 'sometimes|string',
             'document' => 'sometimes|required|min:7|max:16',
             'address' => 'sometimes|string',
             'user_id' => 'sometimes|required',
        ];
    }
}
