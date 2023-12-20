<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Author;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    protected $model = Author::class;
    public function definition(): array
    {
        return [
            'name'=>$this->faker->name,
            'phone'=>$this->faker->phoneNumber,
            'email'=>$this->faker->unique()->safeEmail,
            'imgUrl'=>$this->faker->imageUrl
        ];
    }
}
