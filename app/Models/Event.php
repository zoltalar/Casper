<?php

namespace App\Models;

class Event extends Base
{
    protected $table = 'events';

    protected $guarded = ['id'];

    public static function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date'
        ];
    }
}