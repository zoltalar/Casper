<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function load()
    {
        $users = User::search(['first_name', 'last_name', 'email'])
            ->take(8)
            ->get()
            ->map(function($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->fullName(),
                    'email' => $user->email
                ];
            });

        return $users;
    }
}