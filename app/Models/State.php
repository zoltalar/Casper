<?php

namespace App\Models;

class State extends Base
{
    public $timestamps = false;

    protected $table = 'states';

    protected $guarded = ['id'];

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }
}