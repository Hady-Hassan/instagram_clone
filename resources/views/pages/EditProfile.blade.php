@extends('layouts.default')
@section('page_title', 'Edit')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <link rel="stylesheet" href="./stylesheet.css" />
    <link rel="icon" type="image/x-icon" href="/assets/icons8-instagram-color-32.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Instagram</title>
</head>

<body>
    <div class="container">

        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="{{ROUTE('users.edit')}}" class="list-group-item list-group-item-action active" style="padding: 13px;"> Edit
                        profile</a>
                    <a href="{{ROUTE('users.editpassword')}}" class="list-group-item list-group-item-action" style="padding: 13px;">Change
                        Password</a>
                    <a href="#" class="list-group-item list-group-item-action" style="padding: 13px;">Blocked users</a>
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
                        <!-- <label for="phonenumber" class="col-sm-2 col-form-label  ">Phone Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="{{ $user->phone }}">
                        </div> -->
                        <label class="form-label col-sm-2 col-form-label" for="customFile">Change Image</label>
                        <div class="col-sm-10">
                        <input type="file" class="form-control" id="customFile" name="avatar"/>
                        </div>
                    </div>



                    <center>
                        <button class="btn btn-primary fw-bold bg-gradient " href="#" type="submit">
                            Submit
                        </button>
                    </center>

                </form>

                <form class="bg-white border py-4 px-5" method="POST">
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label  ">Email</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="email" name="email" value="AhmedHaggag720@gmail.com">
                        </div>

                        <div class="col-sm-2">
                            <button class="btn btn-primary fw-bold bg-gradient" href="#" type="submit">
                                Verify
                            </button>
                        </div>

                    </div>
                </form>


                <form class="bg-white border py-4 px-5" method="POST">
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label  ">Email</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="email" name="email" value="AhmedHaggag720@gmail.com">
                        </div>
                        <div class="col-sm-2 mt-auto mb-auto">
                            <span class="badge bg-dark">Verified</span>
                        </div>



                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
@endsection