<?php

namespace App\Models;

use App\Contracts\Userstamp;
use App\Traits\Userstampable;

class Event extends Base implements Userstamp
{
    use Userstampable;

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
            'date' => 'required|date'
        ];
    }
}