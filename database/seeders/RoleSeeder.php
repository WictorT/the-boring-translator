<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::firstOrCreate(['name' => User::ROLE_ADMIN]);
        $userRole = Role::firstOrCreate(['name' => User::ROLE_USER]);

        $readPermission = Permission::where(['name' => 'read'])->first();
        $writePermission = Permission::where(['name' => 'write'])->first();

        $adminRole->givePermissionTo($readPermission);
        $adminRole->givePermissionTo($writePermission);

        $userRole->givePermissionTo($readPermission);
    }
}
