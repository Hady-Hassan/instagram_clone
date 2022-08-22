<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;
use Illuminate\Support\Facades\Auth;

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
    public function edit()
    {
        $id=auth()->user()->id;
        return view("pages.Editprofile")->with(['user' => User::find($id), 'id' => $id]);
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
        $id=auth()->user()->id;

        $name = $request->input('name');
        $fullname = $request->input('fullname');
        $username = $request->input('username');
        $website = $request->input('website');
        $bio = $request->input('bio');
        $phonenumber = $request->input('phonenumber');
        $gender = $request->input('gender');

        if ($request->hasfile('avatar')) {
            $avatar = $request->file('avatar')->store('posts', 'public');
        }
        User::find($id)->update(['name' => $name, 'fullname' => $fullname , 'username' => $username , 'website' => $website , 'bio' => $bio , 'phonenumber' => $phonenumber  , 'gender' => $gender , 'avatar' => $avatar]);

        return redirect()->route('users.edit');
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
}
