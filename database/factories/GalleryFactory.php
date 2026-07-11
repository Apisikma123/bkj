<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'image_path' => 'galleries/mock_' . fake()->numberBetween(1, 10) . '.jpg',
            'gallery_category_id' => null, // Optional, can create a category if needed
        ];
    }
}
