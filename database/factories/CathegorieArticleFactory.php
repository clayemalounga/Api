<?php

namespace Database\Factories;

use App\Models\CathegorieArticle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<CathegorieArticle>
 */
class CathegorieArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cathegorie = $this->faker->randomElement(['Sportive','Divertissement','Documentaire']);
        return [
            'nom_cathegorie'=> $cathegorie,
        ];
    }
}
