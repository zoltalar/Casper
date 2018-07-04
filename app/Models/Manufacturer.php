<?php

namespace App\Models;

class Manufacturer extends Base
{
    public $timestamps = false;

    protected $table = 'manufacturers';

    protected $guarded = ['id'];
}