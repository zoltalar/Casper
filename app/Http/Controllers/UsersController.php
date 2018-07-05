<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsersController extends Controller
{
    public function load()
    {
        $users = User::search(['first_name', 'last_name', 'email'])
            ->where('id', '<>', auth()->id())
            ->take(8)
            ->get()
            ->map(function($user) {
                return [
                    'id' => encrypt($user->id),
                    'name' => $user->fullName(false),
                    'email' => $user->email
                ];
            });

        return $users;
    }
}