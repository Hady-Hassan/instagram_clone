<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\User_follow;
use App\Models\User_block;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Usercontroller extends Controller
{

    function index()
    {
        $users = User::withcount('posts')-> simplepaginate(20);

        return view("users.index")->with('users',$users);

    }

    function gprof($username){
        if(auth()->user()->username ==  $username){
            return redirect()->route('users.profile');
        }


        $user=User::where('username' , $username)->get()->first();
        if(! $user->isBlockedBy(auth()->user())){
        return view("pages.gprof")->with('user' , $user);
        }
        else {
            return redirect()->route('home');
        }
    }

    function create()
    {
        return view("users.create");
    }

    function store(Request $request)
    {
    User::create(
        ['name' => $request['name'] , 'email' => $request['email'],'password'=>$request['pass']]
        );
        return "<h1>Name: ".$request['name']."</h1><br>"."<h1>Email: ".$request['email']."</h1><br> <h2>has been Stored</h2>";
    }
    function show($id)
    {


    $user =User::where('id', $id)->get()->first();
    $posts = User::find($user['id'])->posts;
    return view("users.show",['user'=>$user,'posts'=>$posts]);
    }
    function edit($id)
    {
        $user =User::where('id', $id)->get()->first() ;
        return view("users.edit")->with('user',$user);
    }


    function update(Request $request , $id)
    {
    User::find($id)->update(
        ['name' => $request['name'] , 'email' => $request['email'],'password'=>$request['pass']]
        );
        return "<h1>Name: ".$request['name']."</h1><br>"."<h1>Email: ".$request['email']."</h1><br>";
    }

    function destroy($id)
    {
        $user =User::where('id', $id)->get()->first();
        User::where('id', $id)->get()->first()->delete();
        return "<h1>Name: ".$user['name']."</h1><br>"."<h1>Email: ".$user['email']."</h1><br> <h2>has been Deleted</h2>";
    }





    function search(Request $request){
        if($request->ajax()){
            $search = User::where('username', 'like',"%".$request->keyword."%")->orWhere('fullname', 'like',"%".$request->keyword."%")->limit(10)->get();

            if($search->isEmpty()){
                return ['message'=>"empty","status"=>"failed"];
            }else{
                return  view('includes.dropdown_search')->with('users',$search);
            }
        }else{
            return false;
        }
    }

    function removefollow(Request $request){

        if($request->ajax()){
            $remove = User_follow::where('user_id',$request->userid)->where('target_id' , auth()->user()->id)->delete();

            if(!$remove){
                return ['message'=>"empty","status"=>"failed"];
            }else{
                return json_encode(['message'=>"delete success","status"=>"success"]);
            }
        }else{
            return false;
        }


    }

    function unfollow(Request $request){

        if(auth()->user()->id ==  $request->userid){
            return redirect()->back();
        }

        if($request->ajax()){
            $remove = User_follow::where('target_id',$request->userid)->where('user_id' , auth()->user()->id)->delete();

            $posts = auth()->user()->savedposts()->filter(function($post) use($request){
                return $post->post->user_id == $request->userid;
            });
            foreach($posts as $post){
                $post->delete();
            }


            if(!$remove){
                return ['message'=>"empty","status"=>"failed"];
            }else{
                return json_encode(['message'=>"delete success","status"=>"success"]);
            }
        }else{
            $remove = User_follow::where('target_id',$request->userid)->where('user_id' , auth()->user()->id)->delete();

            $posts = auth()->user()->savedposts()->filter(function($post) use($request){
                return $post->post->user_id == $request->userid;
            });
            foreach($posts as $post){
                $post->delete();
            }

            if(!$remove){
                return redirect()->back();
            }else{
                return redirect()->back();
            }

        }




    }

    function follow(Request $request){

        if(auth()->user()->id ==  $request->userid){
            return redirect()->back();
        }

        if($request->ajax()){
            $remove = User_follow::create([  'user_id' => auth()->user()->id  , 'target_id' => $request->userid]);

            if(!$remove){
                return ['message'=>"empty","status"=>"failed"];
            }else{
                return json_encode(['message'=>"delete success","status"=>"success"]);
            }
        }else{
            $remove = User_follow::create([  'user_id' => auth()->user()->id  , 'target_id' => $request->userid]);

            if(!$remove){
                return redirect()->back();
            }else{
                return redirect()->back();
            }

        }





    }

    function block(Request $request){

        if(auth()->user()->id ==  $request->userid){
            return redirect()->back();
        }
        if($request->ajax()){
            $remove = User_block::create([  'user_id' => auth()->user()->id  , 'target_id' => $request->userid]);
            $rem = User_follow::where('target_id',$request->userid)->where('user_id' , auth()->user()->id)->delete();
            $re = User_follow::where('user_id',$request->userid)->where('target_id' , auth()->user()->id)->delete();

            $posts = auth()->user()->savedposts()->filter(function($post) use($request){
                return $post->post->user_id == $request->userid;
            });
            foreach($posts as $post){
                $post->delete();
            }


            if(!$remove){
                return ['message'=>"empty","status"=>"failed"];
            }else{
                return json_encode(['message'=>"delete success","status"=>"success"]);
            }
        }else{
            $remove = User_block::create([  'user_id' => auth()->user()->id  , 'target_id' => $request->userid]);
            $rem = User_follow::where('target_id',$request->userid)->where('user_id' , auth()->user()->id)->delete();
            $re = User_follow::where('user_id',$request->userid)->where('target_id' , auth()->user()->id)->delete();

            $posts = auth()->user()->savedposts()->filter(function($post) use($request){
                return $post->post->user_id == $request->userid;
            });
            foreach($posts as $post){
                $post->delete();
            }

            if(!$remove){
                return redirect()->back();
            }else{
                return redirect()->back();
            }

        }
    }

}
