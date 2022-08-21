<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fullname' => fake()->name(),
            'username' => fake()->username(),
            'email' => fake()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt(1234), // password
            'remember_token' => Str::random(10),
            'bio'=>fake()->paragraph(),
            'website'=>fake()->url(),
            'gender'=>fake()->randomElement(['m' ,'f']),
            'phone'=>fake()->phoneNumber()
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
