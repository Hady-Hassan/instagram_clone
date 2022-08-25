@extends('layouts.default')
@section('page_title', 'Edit')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ROUTE('users.edit')}}" class="list-group-item list-group-item-action active" style="padding: 13px;"> Edit
                    profile</a>
                <a href="{{ROUTE('users.editpassword')}}" class="list-group-item list-group-item-action" style="padding: 13px;">Change
                    Password</a>
                <a href="{{ROUTE('users.blocked')}}" class="list-group-item list-group-item-action" style="padding: 13px;">Blocked users</a>
            </div>
        </div>

        <div class="col-md-9 px-5">
            <form class="bg-white border py-4 px-5" method="POST" action="{{Route('users.update',['id'=>$user->id])}}" enctype="multipart/form-data">
                @method("PUT")
                @csrf
                <div class="mb-4">
                    <div style="display: inline-block;">
                        <img class="rounded-circle z-depth-2 mr-2" width="70" height="70" style="object-fit:cover ;" alt="100x100" src="{{ auth()->user()->avatar != null ? \Storage::url(auth()->user()->avatar) : asset('temp/assets/no pic.jpg')}}" data-holder-rendered="true">

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
                    <label for="fname" class="col-sm-2 col-form-label  ">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control " id="fullname" name="fullname" value="{{ $user->fullname }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="username" class="col-sm-2 col-form-label  ">UserName</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="username" id="username" value="{{ $user->username }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="website" class="col-sm-2 col-form-label  ">Website</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="website" name="website" value="{{ $user->website }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="bio" class="col-sm-2 col-form-label  ">Bio</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="bio">{{ $user->bio }}</textarea>
                    </div>
                </div>



                <div class="mb-3 row">
                    <label for="phonenumber" class="col-sm-2 col-form-label  ">Phone Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="{{ $user->phone }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label  ">Gender</label>
                    <div class="col-sm-10">
                        <select class="form-select form-select-sm" name="gender" aria-label=".form-select-sm example">

                            <option disabled>Open this select menu</option>
                            <option {{ $user->gender === 'm' ?  "selected" : " "}} value="1">Male</option>
                            <option {{ $user->gender === 'f' ?  "selected" : " "}} value="2">Female</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
              
                    <label class="form-label col-sm-2 col-form-label" for="customFile">Change Image</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="customFile" name="avatar" />
                    </div>
                </div>



                <center>
                    <button class="btn btn-primary fw-bold bg-gradient " href="#" type="submit">
                        Submit
                    </button>
                </center>

            </form>

            <form class="bg-white border py-4 px-5" method="POST" action="{{Route('users.editemail')}}">
                @method("PUT")
                @csrf
                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label  ">Email</label>

                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>

                    <div class="col-sm-2 mb-3">
                        <button class="btn btn-primary fw-bold bg-gradient" href="#" type="submit">
                            Submit
                        </button>
                    </div>
            </form>
            <center>
                @if($user->email_verified_at == null)
                <div class="col-sm-2">
                    <form method="post" action="{{ Route('users.request_email_validation') }}">
                        @csrf
                        <button class="btn btn-primary fw-bold bg-gradient" href="#" type="submit">
                            Verify
                        </button>
                    </form>
                </div>
                @else
                <div class="col-sm-2 mt-auto mb-auto">
                    <span class="badge bg-dark">Verified</span>
                </div>
        </div>
        @endif
        </center>
    </div>
 
</div>
</div>
</div>




@endsection