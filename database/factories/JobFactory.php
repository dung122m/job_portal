<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle,
//            'user_id' => 1,
            'user_id' => \App\Models\User::pluck('id')->random(),
            'job_type_id' => rand(1,5),
            'category_id' => rand(1,10),
            'salary' => rand(1000, 10000),
            'vacancy' => rand(1,5),
            'location' => fake()->city,
            'description' => fake()->text,
            'benefits' => fake()->text,
            'responsibility' => fake()->text,
            'qualifications' => fake()->text,
            'experience' => rand(1,10),
            'company_name' => fake()->company,
            'company_location' => fake()->city,
            'company_website' => fake()->url,
        ];
    }
}
