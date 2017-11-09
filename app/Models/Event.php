<?php

namespace App\Models;

use App\Contracts\Address;
use App\Contracts\Userstamp;
use App\Traits\Addressable;
use App\Traits\Userstampable;

class Event extends Base implements Address, Userstamp
{
    use Addressable, Userstampable;

    protected $table = 'events';

    protected $guarded = ['id'];

    public function meta()
    {
        $meta = [$this->date];

        if ( (int) $this->all_day != 1) {
            $meta[] = 'at';
            $meta[] = $this->time;
        }

        return implode(' ', $meta);
    }

    public static function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'address' => 'required|string',
            'city' => 'required|string',
            'state_id' => 'required',
            'postal_code' => 'required|digits:5'
        ];
    }
}