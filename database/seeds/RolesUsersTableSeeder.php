<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class RolesUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bindings = ['1' => '1'];

        foreach ($bindings as $userId => $roleId) {
            $user = User::find($userId);

            if ($user !== null) {
                $user->roles()->sync([$roleId]);
            }
        }
    }
}
