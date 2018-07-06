<?php

use App\Constants\Genders;
use App\Models\User;
use Illuminate\Database\Seeder;

final class UsersTableSeeder extends Seeder
{
    /**
     * Number of users to create.
     *
     * @var int
     */
    protected $count = 10;

    public function run()
    {
        foreach ($this->users() as $user) {
            User::firstOrCreate(array_only($user, ['email']), $user);
        }
    }

    /**
     * List of users to create.
     *
     * @return  array
     */
    protected function users()
    {
        $users = [];

        array_push($users, [
            'first_name' => 'John',
            'last_name' => 'Smith',
            'email' => 'admin@example.com',
            'nick' => 'admin',
            'password' => bcrypt('test'),
            'dob' => '1983-02-21',
            'gender' => Genders::MALE
        ]);

        if ($this->count > 0) {
            $faker = Faker\Factory::create();

            for ($i=0; $i<$this->count; $i++) {
                array_push($users, [
                    'first_name' => $faker->firstNameMale,
                    'last_name' => $faker->lastName,
                    'email' => $faker->safeEmail,
                    'nick' => $faker->userName,
                    'password' => bcrypt('test'),
                    'dob' => $faker->date('Y-m-d', '-24 years'),
                    'gender' => Genders::MALE
                ]);
            }
        }

        return $users;
    }
}
