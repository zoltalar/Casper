<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentalRequest extends FormRequest
{
    // Override
    protected function validationData()
    {
        $data = $this->all();

        if (isset($data['user_id']) && ! empty($data['user_id'])) {
            $data['user_id'] = decrypt($data['user_id']);
        }

        if (isset($data['car_id']) && ! empty($data['car_id'])) {
            $data['car_id'] = decrypt($data['car_id']);
        }

        return $data;
    }

    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'user_id' => strtolower(__('phrases.user')),
            'event_id' => strtolower(__('phrases.event'))
        ];
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'from' => 'required|date_format:Y-m-d H:i:s',
            'to' => 'required|date_format:Y-m-d H:i:s|after:from'
        ];
    }
}
