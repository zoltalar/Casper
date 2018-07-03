<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * @var int
     */
    private $count = 10;

    public function run()
    {
        $users = [];

        array_push($users, [
            'first_name' => 'John',
            'last_name' => 'Smith',
            'email' => 'admin@example.com',
            'nick' => 'admin',
            'password' => bcrypt('welcome!'),
            'dob' => '1983-02-21',
            'gender' => 'm'
        ]);

        $faker = Faker\Factory::create();

        for ($i=0; $i<$this->count; $i++) {
            array_push($users, [
                'first_name' => $faker->firstNameMale,
                'last_name' => $faker->lastName,
                'email' => $faker->safeEmail,
                'nick' => $faker->userName,
                'password' => bcrypt('welcome!'),
                'dob' => $faker->date('Y-m-d', '-24 years'),
                'gender' => 'm'
            ]);
        }

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
