@extends('layouts.default')
@section('page_title', 'Edit')

@section('content')

<div class="row">
    <div class="col-md-3">
        <div class="list-group">
            <a href="{{ROUTE('users.edit')}}" class="list-group-item list-group-item-action " style="padding: 13px;"> Edit
                profile</a>
            <a href="{{ROUTE('users.editpassword')}}" class="list-group-item list-group-item-action active" style="padding: 13px;">Change
                Password</a>
            <a href="{{ROUTE('users.blocked')}}" class="list-group-item list-group-item-action" style="padding: 13px;">Blocked users</a>
        </div>
    </div>


    <div class="col-md-9 px-5">
        <form class="bg-white border py-4 px-5" method="POST" action="{{Route('users.updatepassword',['id'=>$user->id])}}">
            @method("PUT")
            @csrf
            <div class="mb-4">
                <div style="display: inline-block;">
                    <img class="rounded-circle z-depth-2 mr-2" alt="100x100"  width="70" height="70" style=" display: inline-block; object-fit:cover ;"  src="{{ auth()->user()->avatar != null ? \Storage::url(auth()->user()->avatar) : asset('temp/assets/no pic.jpg')}}" data-holder-rendered="true">

                </div>
                <div class="px-5" style="display: inline-block;">
                    <h5 type="text" class="text-left " style="display: inline-block;"> {{ $user->fullname }}</h5>
                </div>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(session()->has('success'))
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mx-auto mt-2">
                        <div class="alert alert-success">
                            <p><strong>{{ session()->get('success') }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="mb-3 row">
                <label for="OldPassword" class="col-sm-2 col-form-label  ">Old Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="oldpassword" name="oldpassword">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="username" class="col-sm-2 col-form-label  ">New Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="newpassword" name="newpassword">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="username" class="col-sm-2 col-form-label  ">Confrim New Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="confrimnewpassword" name="confirmnewpassword">
                </div>
            </div>


            <center>
                <button class="btn btn-primary fw-bold bg-gradient " href="#" type="submit">
                    Change Password
                </button>

                <div class="my-4">
                    <a href="#" style="text-decoration: none">Forgot password?</a>
                </div>
            </center>



        </form>


    </div>
</div>


@endsection