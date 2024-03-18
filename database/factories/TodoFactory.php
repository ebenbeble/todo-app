<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'title'=> $this->faker->unique()->sentence,
            'description' => $this->faker->realText($maxNbChars = 50),
            'due_date' => $this->faker->dateTimeInInterval('-1 week', '+2 weeks'),
            'priority' => $this->faker->randomElement(array('High', 'Medium', 'Low')),
            'is_completed' => 'Pending'
        ];
    }
}
