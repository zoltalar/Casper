<?php

namespace App\Models;

final class Model extends Base
{
    public $timestamps = false;

    protected $table = 'models';

    protected $guarded = ['id'];

    public function make()
    {
        return $this->belongsTo(Make::class);
    }

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}