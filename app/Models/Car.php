<?php

namespace App\Models;

final class Car extends Base
{
    public $timestamps = false;

    protected $table = 'cars';

    protected $guarded = ['id'];

    public function model()
    {
        return $this->belongsTo(Model::class);
    }
}