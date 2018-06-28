<?php

namespace App\Traits;

use Validator;

trait Addressable
{
    public function address($glue = '\n')
    {
        if ($glue == ',') {
            $glue = ', ';
        }

        $address = $this->address;

        if ( ! empty($this->address_2)) {
            $address .= ( ! empty($address) ? $glue : '') . $this->address_2;
        }

        $middle = $this->city;

        if ( ! empty($this->state_id)) {
            $middle .= ( ! empty($middle) ? ', ' : '') . $this->state->name;
        }

        if ( ! empty($this->postal_code)) {
            $middle .= ( ! empty($middle) ? ' ' : '') . $this->postal_code;
        }

        if ( ! empty($middle)) {
            $address .= ( ! empty($address) ? $glue : '') . $middle;
        }

        if ( ! empty($this->state_id)) {
            $address .= ( ! empty($address) ? $glue : '') . $this->state->country->name;
        }

        return $address;
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }

    public static function generateAddress(array $data, $glue = '\n')
    {
//        $keys = ['address', 'address_2', 'city', 'state_id', 'postal_code'];
//        $data = array_only($data, $keys);
//        $validator = Validator::make($data, $rules);
//
//        if ($validator->passes()) {
//            $model = new static();
//            $model->fill($data);
//
//            return $model->address($glue);
//        }

        return null;
    }
}