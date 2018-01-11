<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function load()
    {
        return User::search(['first_name', 'last_name', 'email'])
            ->take(5)
            ->get()
            ->toJson();
    }
}