<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class media extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // make random media for each post
        $posts = \App\Models\Post::all();
        foreach ($posts as $post) {
            // make random number of media for each post
            $media_count = rand(1, 3);
            for ($i = 0; $i < $media_count; $i++) {

                $random = \Storage::files('public/posts/images');
                $path = \Arr::random($random);

                $media = \App\Models\Media::create([
                    'post_id' => $post->id,
                    'path' => $path,
                    'type' => 'p',
                ]);

            }

        }
    }
}