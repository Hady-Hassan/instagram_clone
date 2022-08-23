@extends('layouts.default')
@section('page_title', 'Profile')

@section('content')

<div class="container my-4 text-center px-5" >
    <div class="row">
       <div class="col-md-8 mx-auto">
           <div class="row">
     <div class="col-md-4 text-right px-3 d-flex flex-wrap align-items-center
     ">
       <img class="rounded-circle z-depth-2 mr-2 mx-3 align-middle"  alt="100x100"
       width="150" height="150" style="object-fit:cover ;"
                               src="{{ $user->avatar != null ? \Storage::url($user->avatar) : asset('temp/assets/no pic.jpg')}}"
                               data-holder-rendered="true">
     </div>
     <div class="col-md-8 float-start">
       <div class="row float-start ">
           <ul class="list-inline ">
               <li class="list-inline-item me-3" ><h2 class="pt-4">{{$user->fullname}}</h2></li>

               @if(auth()->user()->isFollowing($user) )
               <form class="list-inline-item me-3" method="POST" action="{{Route('users.unfollow')}}">
                @csrf
               <li class="list-inline-item me-3"><button type="submit" class="btn btn-primary" style="color: white"><b>UnFollow</b></button></li>
               <input type="hidden" name="userid" value="{{ $user->id }}" />
            </form>
               @else
               <form class="list-inline-item me-3" method="POST" action="{{Route('users.follow')}}">
                @csrf
                 <li class="list-inline-item me-3"><button type="submit" class="btn btn-primary" style="color: white"><b>Follow</b></button></li>
               <input type="hidden" name="userid" value="{{ $user->id }}" />
            </form>
                @endif
            </ul>

       </div>
       <div class="row float-start"  >
           <ul class="list-inline " >
               <li class="list-inline-item me-5"  ><span class="list-inline-item"><b>   {{$user->posts->count()}}</b></span> posts</li>
               <li class="list-inline-item me-5"><button class="btn noHover" data-bs-toggle="modal" data-bs-target="#f1" ><span class="list-inline-item"><b>{{$user->followers->count()}}</b></span> followers</button></li>
               <li class="list-inline-item me-5"><button class="btn noHover" data-bs-toggle="modal" data-bs-target="#f2"><span class="list-inline-item"><b>{{$user->following->count()}}</b></span> following</button></li>

           </ul>


       <div class="row float-start">
        <b>{{$user->username}}</b>
       <div class="col float-start">    <b>{{$user->username}}</b>
       </div>

       </div>
       <div class="row float-start">
           <p style="text-align: left;">Lorem ipsum dolor sit, amet consectetur adipisicing elit 📷✈️🏕️
           </p>
           <a class="text-start" href="#">www.google.com</a>
           </div>
</div>

     </div>
    </div>
   </div>
   <!-- End of Header -->





@endsection
