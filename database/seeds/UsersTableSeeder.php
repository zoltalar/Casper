<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [];

        array_push($users, [
            'first_name' => 'John',
            'last_name' => 'Smith',
            'email' => 'wojciech.pirog@polcode.net',
            'nick' => 'wpirog',
            'password' => bcrypt('welcome!'),
            'dob' => '1983-02-21',
            'gender' => 'm'
        ]);

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
