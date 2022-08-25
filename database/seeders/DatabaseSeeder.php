<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //hady hassan account
        \App\Models\User::create([
            'fullname' =>'Hady Hassan' ,
            'username' =>'Hady_Hassan' ,
            'email' => 'hadyhassn5@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt(1234), // password

            'bio'=>'',
            'website'=>'',
            'gender'=>'m',
            'phone'=> '01284630902'
        ]);

        //Mohammed Hesham account
        \App\Models\User::create([
            'fullname' =>'Mohamed Hesham' ,
            'username' =>'RaidenShurikens' ,
            'email' => 'moohisham2000@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt(1234), // password

            'bio'=>'WUT',
            'website'=>'',
            'gender'=>'m',
            'phone'=> '01062845966'
         ]);

        //Ahmed Hagag account
        \App\Models\User::create([
            'fullname' =>'Ahmed Haggag' ,
            'username' =>'Hego' ,
            'email' => 'AhmedHaggag720@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt(1234), // password

            'bio'=>'Just Student',
            'website'=>'www.Ahmed.com',
            'gender'=>'m',
            'phone'=> '01288339181'
        ]);
        //Omar Abd El fatah account
        \App\Models\User::create([
            'fullname' =>'Omar Abd El fatah' ,
            'username' =>'omar.abd.el.fattah' ,
            'email' => 'omar.mero200125@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt(1234), // password

            'bio'=>'فاطمة #كشري',
            'website'=>'',
            'gender'=>'m',
            'phone'=> '01014513476'
         ]);

        //Abdelrahman Ahmed account
        \App\Models\User::create([
            'fullname' =>'Abdelrahman Hussein' ,
            'username' =>'S7S' ,
            'email' => 'abdelrhman.ahmed54@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt(1234), // password

            'bio'=>'FML',
            'website'=>'https://yts.mx/',
            'gender'=>'m',
            'phone'=> '01111507177'
         ]);
        \App\Models\User::factory(200)->create();
        \App\Models\Post::factory(2000)->create();
        $this->call(media::class);

        \App\Models\Comment::factory(2500)->create();

        \App\Models\User_block::factory(100)->create();

        \App\Models\User_follow::factory(500)->create();

        \App\Models\Post_like::factory(4000)->create();

        \App\Models\User_post_save::factory(250)->create();

        \App\Models\User_comment_like::factory(500)->create();


    }
}
