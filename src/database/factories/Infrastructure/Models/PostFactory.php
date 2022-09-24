<?php

declare(strict_types=1);

namespace Database\Factories\Infrastructure\Models;

use App\Infrastructure\Models\Post;
use App\Infrastructure\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'            => User::inRandomOrder()->first(),
            'title'              => fake()->title(),
            'body'               => fake()->realText(),
            'top_image_path'     => fake()->url(),
            'is_public'          => rand(0, 1)
        ];
    }
}
