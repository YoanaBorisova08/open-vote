<?php

namespace Database\Factories;

use App\Enums\SuggestionStatus;
use App\Models\Suggestion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Suggestion>
 */
class SuggestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(6),
            'description' => fake()->paragraph(3),
            'status' => fake()->randomElement(SuggestionStatus::cases())->value,
        ];
    }
}
