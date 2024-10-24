<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class JobTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jobTypes = [
            'Full Time',
            'Part Time',
            'Contract',
            'Internship',
            'Temporary',
            'Freelance'
        ];
        return [
            'name' => $this->faker->unique()->randomElement($jobTypes),
        ];
    }
}
