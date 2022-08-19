<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname',255);
            $table->string('email',255)->unique();
            $table->string('username',255);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',255);
            $table->string('bio',500)->nullable();
            $table->string('website',255)->nullable();
            $table->string('avatar',255)->nullable();
            $table->enum('gender',['m','f']);
            $table->string('phone',255);

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
