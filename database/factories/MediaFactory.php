<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // // if( $faker->randomElement(['v', 'p']) == 'v'){
        //     $type = 'v';
        //     $path = $faker->image('public/posts/images',640,480, null, false);

        // // }else{
        // //     $type = 'p';
        // //     $path = $faker->image('public/posts/videos',640,480, null, false);

        // // }

        // return [
        //     'post_id' => \App\Models\Post::inRandomOrder()->first()->id,
        //     'type' => $type,
        //     'path' => $path,
        // ];
    }
}
