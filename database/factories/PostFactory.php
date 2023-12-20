<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Post::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'imgUrl' => $this->faker->imageUrl,
            'published_at' => $this->faker->dateTimeThisMonth,
            'author_id' => function () {
                return \App\Models\Author::factory()->create()->id;
            },
        ];
    }
}
