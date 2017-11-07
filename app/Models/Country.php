<?php

namespace App\Models;

class Country extends Base
{
    const ID_POLAND = 1;
    const ID_UNITED_STATES = 2;

    public $timestamps = false;

    protected $table = 'countries';

    protected $guarded = ['id'];
}