<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed the users table
        User::factory()->count(10)->create();

        // Seed the categories
        $categories = [
            'Laravel', 'PHP', 'JavaScript', 'Vue.js', 'React', 'CSS'
        ];

        foreach ($categories as $category) {
            Category::create(['title' => $category]);
        }

        $laravelCategory = Category::where('title', 'Laravel')->first();
        $phpCategory = Category::where('title', 'PHP')->first();
        $javascriptCategory = Category::where('title', 'JavaScript')->first();
        $cssCategory = Category::where('title', 'CSS')->first();

        // Seed the posts and comments
        // Assuming users are created with ids 1-10, we can assign them randomly
        Post::create([
            'title' => 'Laravel 11 is released',
            'author_id' => rand(1, 10),  // Random user as author
            'body' => 'Laravel 11 is released and it has many new features.',
            'category_id' => $laravelCategory->id,
        ])->comments()->createMany([
            ['body' => 'This is a bad post.', 'author_id' => rand(1, 10)],
            ['body' => 'I hate Laravel.', 'author_id' => rand(1, 10)],
            ['body' => 'This is a terrible post.', 'author_id' => rand(1, 10)],
            ['body' => 'I dislike Laravel.', 'author_id' => rand(1, 10)]
        ]);

        $phpPost = Post::create([
            'title' => 'PHP 8.4 is in the making',
            'author_id' => rand(1, 10),
            'body' => 'PHP 8.4 is in the making and it has many new features.',
            'category_id' => $phpCategory->id,    
        ])->comments()->createMany([
            ['body' => 'This is a great post.', 'author_id' => rand(1, 10)],
            ['body' => 'I love PHP.', 'author_id' => rand(1, 10)],
        ]);

        $jsPost = Post::create([
            'title' => 'JS and NPM',
            'author_id' => rand(1, 10),
            'body' => 'Not so informative',
            'category_id' => $javascriptCategory->id,
        ])->comments()->createMany([
            ['body' => 'Very helpful JS information.', 'author_id' => rand(1, 10)],
        ]);

        $cssPost = Post::create([
            'title' => 'Tailwind CSS',
            'author_id' => rand(1, 10),
            'body' => 'Too long',
            'category_id' => $cssCategory->id,
        ]);

        // Generate comments using a factory
        Comment::factory()->count(75)->for($cssPost)->create();
    }
}
