<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // get followed users id
        $users = auth()->user()->following()->pluck('target_id');

        // get followed users posts by id
        $posts = Post::whereIn('user_id',$users)->get();

        return view('pages.home')->with('posts',$posts);
    }

    public function get_all_comments(request $request){
        $users = auth()->user()->following()->pluck('target_id');
        $post = Post::whereIn('user_id',$users)->where('id',$request->post_id)->get();
        if($post == null or empty($post)){
            return "Post not found";
        }else{

            return response()->json([$post->comments],200);

        }
    }

}
