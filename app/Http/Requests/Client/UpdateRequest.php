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
            'name' => 'sometimes|required|string',
            'email' => 'sometimes|required|email',
            'phone' => 'sometimes|required|string',
            'city' => 'sometimes|required|string',
            'document' => 'sometimes|required|min:7|max:16',
            'user_id' => 'sometimes|required',
        ];
    }
}
