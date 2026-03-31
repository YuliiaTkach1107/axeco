<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Topic;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Article::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(6),
            'description' => $this->faker->paragraph(2),
            'image_url' => 'images/page_accueil/news.jpg', // можно faker->imageUrl() для случайных
            'topic_id' => Topic::inRandomOrder()->first()->id,
            'date_publication' => $this->faker->date(),
            'content' => $this->faker->paragraphs(5, true),
        ];
    }
}
