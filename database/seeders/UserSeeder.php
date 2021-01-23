<?php

namespace Database\Seeders;

use App\Models\Key;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::count()) {
            return;
        }

        /** @var User $admin */
        $admin = User::updateOrCreate(
            ['email' => 'admin@lokalize.com'],
            ['token' => $this->generateUserToken()]
        );

        /** @var User $user */
        $user = User::updateOrCreate(
            ['email' => 'user@lokalize.com'],
            ['token' => $this->generateUserToken()]
        );

        $adminRole = Role::where(['name' => User::ROLE_ADMIN])->first();
        $userRole = Role::where(['name' => User::ROLE_USER])->first();

        $admin->assignRole($adminRole);
        $user->assignRole($userRole);
    }

    private function generateUserToken(): string
    {
        return Str::random(32);
    }
}
