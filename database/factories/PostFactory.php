<?php

namespace Database\Factories;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->text(100);
        $now=Carbon::now();
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->text(300),
            'category_id' => rand(1,3),
            'user_id' => rand(1, 3),
            'tag_id'=>rand(1,3),
            'thumbnail' => fake()->imageUrl(540, 480, 'animals', true),
            'created_at'=>$now
        ];
    }
}
