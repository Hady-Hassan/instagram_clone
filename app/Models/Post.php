<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function lastComments()
    {
        return $this->comments()->orderBy('created_at', 'desc')->limit(3);
    }

    public function media(){
        return $this->hasMany(Media::class);
    }

    public function likes()
    {
        return $this->hasMany(Post_like::class);
    }
    
    public function saves()
    {
        return $this->hasMany(User_post_save::class);
    }

    public function isLiked(){
        return $this->likes()->where('user_id',  auth()->id())->exists();

    }
    
    public function isSaved(){
        return $this->saves()->where('user_id',  auth()->id())->exists();
    }

 
}
