@extends('layouts.default')
@section('page_title', 'Edit')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="list-group">
            <a href="{{ROUTE('users.edit')}}" class="list-group-item list-group-item-action " style="padding: 13px;"> Edit
                profile</a>
            <a href="{{ROUTE('users.editpassword')}}" class="list-group-item list-group-item-action " style="padding: 13px;">Change
                Password</a>
            <a href="{{ROUTE('users.blocked')}}" class="list-group-item list-group-item-action active" style="padding: 13px;">Blocked users</a>
        </div>
    </div>

    <div class="col-md-8">
       


        <table class="table table-borderless">
            <tbody>
                <tr>
                    @foreach( auth()->user()->blocked_users as $user )
                    <td class="align-middle"> <img src="{{ $user->avatar != null ? \Storage::url($user->avatar) : asset('temp/assets/no pic.jpg')}}" class="rounded-circle " width="60" height="60" style="object-fit:cover ;" alt="Avatar" /></td>
                    <td class="align-middle">
                        <h4>{{$user->fullname}}</h4>
                        <h6 class="text-muted">{{$user->username}}</h6>
                    </td>
                    <td class="align-middle ">
                        <center>
                            <button class="btn btn-danger fw-bold  bg-gradient " type="submit" onclick="unblock({{$user->id}})">
                                Unblock
                            </button>
                        </center>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>

    </div>


</div>

@endsection