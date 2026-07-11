<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence();
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => fake()->paragraphs(5, true),
            'thumbnail' => 'blogs/mock_' . fake()->numberBetween(1, 10) . '.jpg',
            'is_published' => true,
            'views' => fake()->numberBetween(0, 1000),
        ];
    }
}
