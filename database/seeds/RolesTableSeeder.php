<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

final class RolesTableSeeder extends Seeder
{
    public function run()
    {
        foreach ($this->roles() as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }

    /**
     * List of roles to create.
     *
     * @return  array
     */
    protected function roles()
    {
        return ['admin', 'user'];
    }
}
