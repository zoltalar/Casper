<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['id'];

    protected $hidden = [
        'password', 'remember_token',
    ];

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
