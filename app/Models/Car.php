<?php

namespace App\Models;

class Car extends Base
{
    public $timestamps = false;

    protected $table = 'cars';

    protected $guarded = ['id'];
}