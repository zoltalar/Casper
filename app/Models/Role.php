<?php

namespace App\Models;

class Role extends Base
{
    public $timestamps = false;

    protected $table = 'roles';

    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'roles_users');
    }
}