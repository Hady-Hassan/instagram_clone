<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\User_follow;
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
        $user=User::where('username' , $username)->get()->first();

        return view("pages.gprof")->with('user' , $user);

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



    function forgot_password_show(){
        $page_title = "Reset password";
        return view('dashboard.forgot_password',compact('page_title'));
    }

    function forgot_password_email_verify(){
        $admin = Admin::where('email',request('email'))->first();
        if(!empty($admin)){

            $token = Password::broker('admin')->createToken($admin);
            DB::table('password_resets')->insert([
                'email'=>$admin->email,
                'token'=>$token,
                'created_at'=>Carbon::now()
            ]);
            Mail::to($admin->email)->send(new AdminResetPassword(['data'=>$admin,'token'=>$token]));
            return redirect()->back()->with('success', 'Reset link is sent to your email address');

         }else{
            return redirect()->back()->withErrors(['email_is_wrong' => 'passwords.user']);
        }
        return back();
    }
    function forgot_password_token_verify($token){
        $check_token =  DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
         if(!empty($check_token)){
            return view('dashboard.forgot_password_final',['data' => $token]);
        }else{
            return redirect(Route('reset_password_final'));
        }
    }
    function forgot_password_final(UpdatePassword $request,$token){
        $check_token =  DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
        if(!empty($check_token)){
            $admin = Admin::where('email',$check_token->email)->update([
                'password' => bcrypt($request->input('password'))
            ]);
            DB::table('password_resets')->where('email',$check_token->email)->delete();
            auth('admin')->attempt(['email'=>$check_token->email,'password'=>$request->input('password')]);
            return redirect(Route('dashboard'));
        }else{
            return redirect(Route('forgot_password'));
        }
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

        if($request->ajax()){
            $remove = User_follow::where('target_id',$request->userid)->where('user_id' , auth()->user()->id)->delete();

            if(!$remove){
                return ['message'=>"empty","status"=>"failed"];
            }else{
                return json_encode(['message'=>"delete success","status"=>"success"]);
            }
        }else{
            $remove = User_follow::where('target_id',$request->userid)->where('user_id' , auth()->user()->id)->delete();

            if(!$remove){
                return redirect()->back();
            }else{
                return redirect()->back();
            }

        }




    }

    function follow(Request $request){

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



}
