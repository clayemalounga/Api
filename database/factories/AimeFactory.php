<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Commentaire;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aime>
 */
class AimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre_like' => fake()->numberBetween(0,10),
            'is_like' => fake()->numberBetween(0,1),
        ];
    }
}
