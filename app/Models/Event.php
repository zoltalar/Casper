<?php

namespace App\Models;

use App\Contracts\Userstamp;
use App\Traits\Userstampable;

class Event extends Base implements Userstamp
{
    use Userstampable;

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