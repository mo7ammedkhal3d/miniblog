<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $authors = \App\Models\Author::factory(3)->create();

        $authors->each(function ($author) {
            \App\Models\Post::factory(5)->create(['author_id' => $author->id]);
        });
    }
}
