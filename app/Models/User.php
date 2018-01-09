<?php

namespace App\Models;

use App\Contracts\Name;
use App\Traits\Namable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;

class User extends Base implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, Name
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable, Namable;

    protected $guarded = ['id'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function events()
    {
        return $this->belongsToMany('App\Models\Event', 'events_users');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'roles_users');
    }

    public static function genders()
    {
        return [
            'm' => 'Male',
            'f' => 'Female'
        ];
    }

    public static function rules()
    {
        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|string|email|unique:users',
            'nick' => 'required|string|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'dob' => 'required|date',
            'gender' => 'required'
        ];
    }
}
