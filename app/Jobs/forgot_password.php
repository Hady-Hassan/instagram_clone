<?php

namespace App\Jobs;
use Illuminate\Auth\Notifications\ResetPassword ;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class forgot_password implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $user; 
    protected $token;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user,String $token)
    {
        //the user property passed to the constructor through the job dispatch method
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->notify(new ResetPassword($this->token));


    }
}
