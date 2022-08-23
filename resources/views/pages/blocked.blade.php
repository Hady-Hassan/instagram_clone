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


   
</div>

@endsection