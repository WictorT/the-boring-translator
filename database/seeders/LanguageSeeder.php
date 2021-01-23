<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Language::count()) {
            return;
        }

        $now = now();

        Language::insert([
            [
                'name' => 'English',
                'iso_code' => 'en',
                'is_rtl' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Romanian',
                'iso_code' => 'ro',
                'is_rtl' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Russian',
                'iso_code' => 'ru',
                'is_rtl' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Chinese',
                'iso_code' => 'zh',
                'is_rtl' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Arabic',
                'iso_code' => 'ar',
                'is_rtl' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
