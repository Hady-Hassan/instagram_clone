<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Media;
use App\Models\Post_like;
use App\Models\User_post_save;
class PostController extends Controller
{
    public function index()
    {
        
        // get followed users id
        $users = auth()->user()->following()->pluck('target_id');
        
        // get followed users posts by id
        $posts = Post::whereIn('user_id',$users)->get()->map(function($post){
            $caption = $post['caption'];
            $caption = explode(' ',$caption);
            for($i=0;$i<count($caption);$i++){
                if(str_contains($caption[$i],"#")){
                    $caption[$i] = "<a href=".Route('tag.show',['tag'=>trim($caption[$i],"#")]).">".$caption[$i]."</a>";
                }
            }
            
            $caption = implode(' ',$caption);
            $post['caption'] = $caption;
            return $post;
        });
   
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = Post::create(
            [
                'caption' => $request->caption,
                'user_id' => auth()->user()->id,
            ]
        );
        $allowedMimeTypes = ['image/jpeg','image/gif','image/png'];

        foreach ($request-> file('media') as $media) 
        {
            $contentType = $media->getClientMimeType();
            $type;
            if(! in_array($contentType, $allowedMimeTypes) ){
            $type = 'v'; 
            }else{
            $type = 'p'; 
            }
            $media = Media::create([
                'post_id'=> $post-> id,
                'Path'=>$media->store('posts/images', 'public'),
                'type'=>$type
                
            ]);
        }
        

        return redirect()->Route('users.profile');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username,$post)
    {
        $user = User::where('username',$username)->first();
        // get followed users id
        $hasAccess = auth()->user()->isFollowing($user);
            if($hasAccess || $user->id == auth()->user()->id){
                // get the post by id   
            $post = Post::where('user_id',$user->id)->where('id',$post)->get()->first();
            
            if($post){
                return view('pages.post')->with('post',$post);
            }else{
                return redirect()->back();
            }

        }else{
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function makeComment(request $request){
        if(\Request::ajax()){

        if(!isset($request->comment) OR empty($request->comment)){
            return false;
        }
        // check if the user has access to this post (if he is following the author)
        $users = auth()->user()->following()->pluck('target_id');
        $post = Post::whereIn('user_id',$users)->where('id',$request->post_id)->get();


        
        if($post == null or empty($post) ){
            return "Post not found";
        }else{
            // insert comment 
            $insert = Comment::create([
                'user_id' => auth()->user()->id,
                'content' => $request->comment,
                'post_id' => $request->post_id
            ]);
            if($insert){
                if($request->type){
                $content = "<small class='col-12  commenting'> <a href='" . Route('users.show',['user' => $insert->user->username]) . "'> <strong class='me-1'>".$insert->user->username."</strong> </a> ".$insert->content." </small>";
            }else {
                return view('includes.comments_post')->with('comment',$insert);
             }
                return json_encode(['message'=>"add success","content"=> $content,"status"=>"success"]);
            }else{
                return json_encode(['message'=>"add failed","status"=>"failed"]);
            }

        }
        }else{
            return json_encode(['message'=>"add failed","status"=>"failed"]);
        }
    }
    public function makeLike(request $request){
        if(\Request::ajax()){
            // check if the user has access to this post (if he is following the author)
            $users = auth()->user()->following()->pluck('target_id');
            $post = Post::whereIn('user_id',$users)->where('id',$request->post_id)->get();
        
            if($post == null or empty($post) ){
                return "Post not found";
            }else{
                // check if he already liked this post
                $check = Post::find($request->post_id)->isLiked();
                if($check){
                    $delete = Post_like::where( 'user_id' , auth()->user()->id)->where( 'post_id' , $request->post_id)->delete();
                    if($delete){
                        return json_encode(['message'=>"delete success","status"=>"success"]);
                    }else{
                        return json_encode(['message'=>"delete failed","status"=>"failed"]);
                    }
                }else{
                    // add like 
                    $insert = Post_like::create([
                        'user_id' => auth()->user()->id,
                        'post_id' => $request->post_id
                    ]);                
                    if($insert){
                        return json_encode(['message'=>"add success","status"=>"success"]);
                    }else{
                        return json_encode(['message'=>"add failed","status"=>"failed"]);
                    }
                }
            }
        }else{
            return json_encode(['message'=>"add failed","status"=>"failed"]);
        }  
    }
    public function savePost(request $request){
        if(\Request::ajax()){
            // check if the user has access to this post (if he is following the author)
            $users = auth()->user()->following()->pluck('target_id');
            $post = Post::whereIn('user_id',$users)->where('id',$request->post_id)->get();
        
            if($post == null or empty($post) ){
                return "Post not found";
            }else{

                    // check if he already saved this post
                    $check = Post::find($request->post_id)->isSaved();
                    if($check){
                        $delete = User_post_save::where( 'user_id' , auth()->user()->id)->where( 'post_id' , $request->post_id)->delete();
                        if($delete){
                            return json_encode(['message'=>"delete success","status"=>"success"]);
                        }else{
                            return json_encode(['message'=>"delete failed","status"=>"failed"]);
                        }
                    }else{
                        // add like 
                        $insert = User_post_save::create([
                            'user_id' => auth()->user()->id,
                            'post_id' => $request->post_id
                        ]);                
                        if($insert){
                            return json_encode(['message'=>"add success","status"=>"success"]);
                        }else{
                            return json_encode(['message'=>"add failed","status"=>"failed"]);
                        }
                    }

            }
        }else{
            return json_encode(['message'=>"add failed","status"=>"failed"]);
        }   
    }
}
