<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class VetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => '10000341',
            'vet_name' => fake()->name(),
            'vet_province' => 'กรุงเทพมหานคร',
            'vet_city' => 'เขตพระนคร',
            'vet_area' => 'แขวงพระบรมมหาราชวัง',
            'user_id' => 1
        ];
    }
}
