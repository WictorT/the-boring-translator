<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User;
        $admin->email = 'admin@lokalize.com';
        $admin->token = $this->generateUserToken();
        $admin->save();

        $user = new User;
        $user->email = 'user@lokalize.com';
        $user->token = $this->generateUserToken();
        $user->save();
    }

    private function generateUserToken(): string
    {
        return Str::random(32);
    }
}
