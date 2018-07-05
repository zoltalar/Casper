<?php

namespace App\Models;

final class Model extends Base
{
    public $timestamps = false;

    protected $table = 'models';

    protected $guarded = ['id'];
}