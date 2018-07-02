<?php

namespace App\Http\Requests;

class EventFilterRequest extends Base
{
    public function attributes()
    {
        return [
            'state_id' => 'state'
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'address' => 'required',
            'city' => 'required',
            'state_id' => 'required',
            'postal_code' => 'required',
            'radius' => 'required'
        ];
    }
}
