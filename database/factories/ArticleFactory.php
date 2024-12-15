<?php

namespace Database\Factories;

use App\Enums\ArticleStatus;
use App\Enums\UserRole;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition(): array
    {
        $title = fake()->unique()->text(80);
        $slug = Str::slug($title);

        $adminOrRedatorUser = User::select('id')
            ->orWhereIn('role', [
                UserRole::ADMIN,
                UserRole::REDATOR,
            ])
            ->inRandomOrder()
            ->first();

        $status = $adminOrRedatorUser->id % 2 ?
            ArticleStatus::RASCUNHO->value :
                ArticleStatus::PUBLICADO->value;

        return [
            'banner' => '/assets/banners/2024/01/05/slug-unico-do-artigo.jpg', // para fins de exemplo
            'title' => $title,
            'subtitle' => fake()->unique()->text(150),
            'content' => fake()->unique()->paragraphs(5, true),
            'slug' => $slug,
            'status' => $status,
            'user_id' => $adminOrRedatorUser->id,
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
