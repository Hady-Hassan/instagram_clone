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
               <li class="list-inline-item me-3"><button type="submit" class="btn btn-primary" style="color: white"><b>Unfollow</b></button></li>
               <input type="hidden" name="userid" value="{{ $user->id }}" />
            </form>
            @elseif (auth()->user()->isBlockedBy($user))
            <button class="btn btn-danger fw-bold  bg-gradient " type="submit" onclick="unblock({{$user->id}})">
                Unblock
            </button>
            @elseif ($user->isFollowing(auth()->user()))
            <form class="list-inline-item me-3" method="POST" action="{{Route('users.follow')}}">
                @csrf
                 <li class="list-inline-item me-3"><button type="submit" class="btn btn-primary" style="color: white"><b>Follow Back</b></button></li>
               <input type="hidden" name="userid" value="{{ $user->id }}" />
            </form>
            @else
               <form class="list-inline-item me-3" method="POST" action="{{Route('users.follow')}}">
                @csrf
                 <li class="list-inline-item me-3"><button type="submit" class="btn btn-primary" style="color: white"><b>Follow</b></button></li>
               <input type="hidden" name="userid" value="{{ $user->id }}" />
            </form>
                @endif

                <li class="list-inline-item me-3"><button style="border: none; background-color: white" data-bs-toggle="modal" data-bs-target="#f2"><svg  xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
  <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
</svg></button></li>

<div style="max-height: 800px;" class="modal fade" id="f2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">

        <div class="modal-body">
            <div class="list-group">
                @if (auth()->user()->isBlockedBy($user))


                <button type="submit" class="list-group-item list-group-item-action" onclick="unblock({{$user->id}})"><span style="color: red">Unblock</span></button>
            @else
            <form method="POST" action="{{Route('users.block')}}">
                @csrf

            <button type="submit" class="list-group-item list-group-item-action" ><span style="color: red">Block</span></button>
            <input type="hidden" name="userid" value="{{ $user->id }}" />

        @endif
                <button type="button" class="list-group-item list-group-item-action"><span style="color: red">Report</span></button>
                <button type="button" class="list-group-item list-group-item-action" data-bs-dismiss="modal">Cancel</button>

              </div>
        </div>

      </div>
    </div>
  </div>




            </ul>

       </div>
       <div class="row float-start"  >
           <ul class="list-inline " >
               <li class="list-inline-item me-5"  ><span class="list-inline-item"><b>   {{$user->posts->count()}}</b></span> posts</li>
               <li class="list-inline-item me-5"><button class="btn noHover"  type="button"><span class="list-inline-item"><b>{{$user->followers->count()}}</b></span> Followers</button></li>
               <li class="list-inline-item me-5"><button class="btn noHover" type="button"><span class="list-inline-item"><b>{{$user->following->count()}}</b></span> Following</button></li>

           </ul>
           </div>

           <div class="row  float-start">
            <div class="col-12  text-start">
                <b>{{$user->username}}</b>
            </div>
            <div class="col-12  text-start">
                <p style="text-align: left;">{{$user->bio}}</p>
            </div>
            <div class="col-12  text-start">
                <a class="text-start" href="{{$user->website}}">{{$user->website}}</a>
            </div>
        



     </div>
    </div>
   </div>
   <!-- End of Header -->
   @if(auth()->user()->isFollowing($user) )

   <div class="container mt-4">
    <div class="row ">
        <ul class="nav nav-tabs w-100 justify-content-center ">
            <li class="nav-item ">
              <a class="nav-link active text-decoration-none text-reset"" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true" href="#"><i class="fa-solid fa-border-all "></i><span class="px-2">Posts</span></a>
            </li>



          </ul>

    </div>

 </div>

     </div>
     <div class="tab-content" id="myTabContent">
         <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
             <div class="container my-1">

                 <div class="row">
                 @foreach ($user->posts as $post )
                 <div class="col-md-4 ">
                     <div class="card  tag_card my-4 m-auto">
                         <div class="card-body">
                             <a href="{{ Route('post.show',['user' =>  $user->username , 'post' => $post->id  ]) }}">
                             @if($post->media->first()->type == 'p')
                             <img src="{{ \Storage::url(  $post->media->first()->Path )   }}" style="max-width:100%"
                                 class="col-12 w-100 m-auto"  alt="...">
                             @else
                                 <video controls class="col-12 w-100 m-auto" style="max-width:100%">
                                     <source src="{{ \Storage::url(  $post->media->first()->Path )   }}" type="video/mp4">
                                 </video>
                             @endif
                             </a>
                         </div>
                     </div>
                     </div>
                 @endforeach
                 </div>
                 </div>
                 </div>







       </div>

 </div>

   @endif




@endsection
