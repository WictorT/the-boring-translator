<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            LanguageSeeder::class,
            KeySeeder::class,
        ]);

        echo 'Admin token:  ' . User::where('email', 'admin@lokalize.com')->first()->token . PHP_EOL;
        echo 'User token:   ' . User::where('email', 'user@lokalize.com')->first()->token . PHP_EOL;
    }
}
