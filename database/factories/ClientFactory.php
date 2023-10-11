<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = \App\Models\Vet::pluck('user_id')->toArray();
        // dd($users);
        return [
            'client_code' => fake()->unique()->numerify('TRIO#####'),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->phoneNumber(),
            'phoneIsVerified' => Str::random(5),
            'vet_id'=>fake()->randomElement($users)
        ];
    }
}
