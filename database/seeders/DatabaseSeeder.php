<?php

namespace Database\Seeders;

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
        Category::create(['title' => 'Laravel']);
        Category::create(['title' => 'PHP']);
        Category::create(['title' => 'JavaScript']);
        Category::create(['title' => 'Vue.js']);
        Category::create(['title' => 'React']);
        Category::create(['title' => 'CSS']);

        $laravel_category = Category::where('title', 'Laravel')->first();
        $php_category = Category::where('title', 'PHP')->first();
        $javascript_category = Category::where('title', 'JavaScript')->first();
        $css_category = Category::where('title', 'CSS')->first();

        // 1st post
        Post::create([
            'title' => 'Laravel 11 is released',
            'author' => 'John Doe',
            'body' => 'Laravel 11 is released and it has many new features.',
            'category_id' => $laravel_category->id,
        ]);
        $firstpost = Post::query()->latest()->first();
        $firstpost->comments()->createMany([
            ['body' => 'This is a bad post.', 'author' => 'Jane Doe'],
            ['body' => 'I hate Laravel.', 'author' => 'Brother Joe'],
            ['body' => 'This is a terrible post.', 'author' => 'John Deere'],
            ['body' => 'I dislike Laravel.', 'author' => 'Jane Maria']
        ]);
        
        // 2nd post
        $php_post = Post::create([
            'title' => 'PHP 8.4 is in the making',
            'author' => 'John Doe',
            'body' => 'PHP 8.4 is in the making and it has many new features.',
            'category_id' => $php_category->id,    
        ]);
        $php_post->comments()->createMany([
            ['body' => 'This is a great post.', 'author' => 'John Doe'],
            ['body' => 'I love Laravel.', 'author' => 'Jane Doe'],
        ]);

        // 3rd post about JS
        $js_post = Post::create([
            'title' => 'JS and NPM',
            'author' => 'Some random guy',
            'body' => 'Not so informative',
            'category_id' => $javascript_category->id,
        ]);
        $js_post->comments()->createMany([
            ['body' => 'Very helpful JS information.', 'author' => 'Bob'],
        ]);
        
        //4th post
        $css_post = Post::create([
            'title' => 'Tailwind CSS',
            'author' => 'MJ',
            'body' => 'Too long',
            'category_id' => $css_category->id,
        ]);
        $css_comments = Comment::factory()->count(75)->make()->toArray();
        $css_post->comments()->createMany($css_comments);
    }
}
