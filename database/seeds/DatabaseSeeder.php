<?php

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RolesUsersTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(EventsTableSeeder::class);
    }
}
