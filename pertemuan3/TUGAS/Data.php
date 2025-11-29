<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'username' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // password default
            'remember_token' => Str::random(10),
        ];
    }
}

    class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'slug' => $this->faker->unique()->slug(),
        ];
    }
}
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,        // random user
            'category_id' => Category::all()->random()->id, // random category
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->unique()->slug(),
            'excerpt' => $this->faker->paragraph(1),
            'body' => $this->faker->paragraph(5),
            'image' => null,
        ];
    }
}
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 5 Users
        User::factory(5)->create();

        // 2 Categories
        Category::factory(2)->create();

        // 10 Posts
        Post::factory(10)->create();
    }
}

