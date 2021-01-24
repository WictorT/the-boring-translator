<?php

namespace Database\Factories;

use App\Models\Key;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Factories\Factory;

class TranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Translation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'value' => $this->faker->realText(),
//             TODO
//            'language_iso_code' => $this->faker->randomElement(Language::all())->iso_code,
            'language_iso_code' => 'en',
            'key_id' => Key::factory()->create()->getKey(),
//             TODO not to forget
//            'is_rtl'
        ];
    }
}