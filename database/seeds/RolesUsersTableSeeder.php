<?php

use App\Models\User;
use Illuminate\Database\Seeder;

final class RolesUsersTableSeeder extends Seeder
{
    public function run()
    {
        foreach ($this->bindings() as $userId => $roleId) {
            $user = User::find($userId);

            if ($user !== null) {
                $user->roles()->sync([$roleId]);
            }
        }
    }

    /**
     * User ID to role ID bindings.
     *
     * @return  array
     */
    protected function bindings()
    {
        return ['1' => '1'];
    }
}
