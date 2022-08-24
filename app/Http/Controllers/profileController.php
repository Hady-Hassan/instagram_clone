<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;
use App\Models\User_block;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class profileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("pages.Editprofile");
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {

        return view("pages.profile");
    }


    public function edit()
    {
        $id = auth()->user()->id;
        return view("pages.Editprofile")->with(['user' => User::find($id), 'id' => $id]);
    }
    public function editpassword()
    {
        $id = auth()->user()->id;
        return view("pages.changePassword")->with(['user' => User::find($id), 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $request->validate([
            'fullname' =>    ['required', 'string', 'max:255'],
            'username' =>    ['required', 'string', 'max:255', 'unique:users,username,' . auth()->user()->id],
            'website' =>     ['max:255'],
            'bio' =>         ['max:500'],
            'phonenumber' => ['required', 'string', 'max:500',  'unique:users,phone,' . auth()->user()->id],
            'gender' =>      ['required'],
        ]);

        $id = auth()->user()->id;

        $name = $request->input('name');
        $fullname = $request->input('fullname');
        $username = $request->input('username');
        $website = $request->input('website');
        $bio = $request->input('bio');
        $phonenumber = $request->input('phonenumber');
        $gender = $request->input('gender');

        if ($request->hasfile('avatar')) {
            $avatar = $request->file('avatar')->store('users', 'public');
            $update =  User::find($id)->update(['name' => $name, 'fullname' => $fullname, 'username' => $username, 'website' => $website, 'bio' => $bio, 'phonenumber' => $phonenumber, 'gender' => $gender, 'avatar' => $avatar]);
        } else {
            $update =   User::find($id)->update(['name' => $name, 'fullname' => $fullname, 'username' => $username, 'website' => $website, 'bio' => $bio, 'phonenumber' => $phonenumber, 'gender' => $gender]);
        }

        if (!$update) {
            return redirect()->back()->withErrors(['error' => 'Update failed, Invalid Data']);
        }

        return redirect()->back()->with('success', 'Profile updated');
    }

    public function updatepassword(Request $request)
    {

        $request->validate([
            'newpassword' => ['required',  Rules\Password::defaults()],
        ]);

        $id = auth()->user()->id;

        $oldpassword = $request->input('oldpassword');
        $newpassword = $request->input('newpassword');
        $confirmnewpassword = $request->input('confirmnewpassword');
        if ($newpassword != $confirmnewpassword || !Hash::check($oldpassword, Auth::user()->password)) {
            return redirect()->back()->withErrors(['error' => 'Update failed, Invalid Data']);
        } else if ($newpassword == $confirmnewpassword || !Hash::check($oldpassword, Auth::user()->password)) {
            User::find($id)->update(['password' => bcrypt($newpassword)]);
            return redirect()->back()->with('success', 'Password update successfully');
        }

        return redirect()->route('users.editpassword');
    }

    public function editemail(Request $request)
    {

        //$user=auth()->user()->hasVerifiedEmail();
        $user = auth()->user();

        $request->validate([
            'email' => ['required', 'string','email',  'max:255', 'unique:users,email,'. auth()->user()->id ],
        ]);
        $id = auth()->user()->id;
        $email = $request->input('email');
        $update = $user->update(['email' => $email,'email_verified_at'=> " "]);

        if( $update ){
            $user->email_verified_at = null;
            $user->save();
            return redirect()->back()->with('success', 'Email update successfully');
        }else{
            return redirect()->back();
        }
    }

    public function blocked(Request $request){
        return view("pages.blocked");



    }

    function unblock(Request $request){

        if($request->ajax()){
            $remove = User_block::where('target_id',$request->userid)->where('user_id' , auth()->user()->id)->delete();
            if(!$remove){
                return ['message'=>"empty","status"=>"failed"];
            }else{
                return json_encode(['message'=>"delete success","status"=>"success"]);
            }
        }else{
            return false;
        }



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

    public function request_email_validation(){
        $send  = auth()->user()->sendEmailVerificationNotification();
        return redirect()->back()->with('success', 'A verification link will be sent to your email now !');
    }
}
