<?php

namespace App\Models;

class Country extends Base
{
    public $timestamps = false;

    protected $table = 'countries';

    protected $guarded = ['id'];
}