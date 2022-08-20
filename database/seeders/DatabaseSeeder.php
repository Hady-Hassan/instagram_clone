<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(150)->create();
        \App\Models\Post::factory(30)->create();
        $this->call(media::class);

        \App\Models\Comment::factory(100)->create();

        \App\Models\User_block::factory(20)->create();

        \App\Models\User_follow::factory(300)->create();

        \App\Models\User_post_like::factory(50)->create();

        \App\Models\User_post_save::factory(50)->create();

        \App\Models\User_comment_like::factory(50)->create();


    }
}
