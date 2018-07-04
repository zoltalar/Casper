<?php

namespace App\Models;

class Make extends Base
{
    public $timestamps = false;

    protected $table = 'makes';

    protected $guarded = ['id'];
}