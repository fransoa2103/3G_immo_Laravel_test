<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * name of teh factory's corresponding model
     *
     * @var [string]
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // factory fait le lien avec la table user et récupère pour chaque 
            // user son id 
            'user_id'   => User::factory(),
            'title'     => $title =$this->faker->sentence,
            'slug'      => Str::Slug($title),
            'content'   => $this->faker->paragraph
        ];
    }
}
