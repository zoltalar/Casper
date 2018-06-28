<?php

namespace App\Http\Requests;

class EventRequest extends Base
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'address' => 'required|string',
            'city' => 'required|string',
            'state_id' => 'required',
            'postal_code' => 'required|digits:5',
            'max_attendees' => 'nullable|numeric'
        ];
    }
}
