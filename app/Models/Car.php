<?php

namespace App\Models;

final class Car extends Base
{
    public $timestamps = false;

    protected $table = 'cars';

    protected $guarded = ['id'];
}