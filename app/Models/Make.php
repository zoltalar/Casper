<?php

namespace App\Models;

final class Make extends Base
{
    public $timestamps = false;

    protected $table = 'makes';

    protected $guarded = ['id'];
}