<?php

namespace Database\Seeders;

use App\Models\Key;
use App\Models\Language;
use Illuminate\Database\Seeder;

class KeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Key::count()) {
            return;
        }

        $now = now();

        Key::insert([
            [
                'name' => 'hello-world',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'lorem-ipsum',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
