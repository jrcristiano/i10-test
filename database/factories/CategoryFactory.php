<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->word();
        $slug = Str::slug($name);

        $adminUser = User::select('id')
            ->whereIn('role', [UserRole::ADMIN])
            ->inRandomOrder()
            ->first();

        return [
            'name' => $name,
            'description' => fake()->sentence(10),
            'slug' => $slug,
            'user_id' => $adminUser->id,
        ];
    }
}
