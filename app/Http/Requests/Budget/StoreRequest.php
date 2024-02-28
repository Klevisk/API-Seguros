<?php

namespace App\Http\Requests\Budget;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required',
            'date' => 'required',
            'total' => 'required',
            'provider_id' => 'required',
            'client_id' => 'required',
            'family_client_id' => 'required',
            'safe_type_id' => 'required',
        ];
    }
}



