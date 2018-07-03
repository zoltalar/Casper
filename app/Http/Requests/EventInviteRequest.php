<?php

namespace App\Http\Requests;

use App\Rules\EventUserRule;

class EventInviteRequest extends Base
{
    // Override
    protected function validationData()
    {
        $data = array_merge($this->all(), [
            'user_id' => null
        ]);

        if (isset($data['id']) && ! empty($data['id'])) {
            $data['user_id'] = decrypt($data['id']);
        }

        unset($data['id']);

        return $data;
    }

    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'user_id' => 'user',
            'event_id' => 'event'
        ];
    }

    public function rules()
    {
        return [
            'user_id' => ['required', 'exists:users,id', new EventUserRule($this->validationData())],
            'event_id' => 'required|exists:events,id'
        ];
    }
}
