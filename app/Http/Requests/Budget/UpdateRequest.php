<?php

namespace App\Http\Requests\Budget;

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
            'name' => 'sometimes|required',
            'date' => 'sometimes|required',
            'total' => 'sometimes|required',
            'provider_id' => 'sometimes|required',
            'client_id' => 'sometimes|required',
            'family_client_id' => 'sometimes|required',
            'safe_type_id' => 'sometimes|required',
        ];
    }
}
