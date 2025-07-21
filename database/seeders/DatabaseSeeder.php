<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::factory()->create([
            'name' => 'Indra',
            'email' => 'test@gmail.com',
        ]);

        $categories = [
            'Technology',
            'Health',
            'Lifestyle',
            'Education',
            'Travel',
            'Food',
            'Finance',
            'Entertainment',
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create(['name' => $category]);
        };

        // Post::factory(100)->create();
    }
}
