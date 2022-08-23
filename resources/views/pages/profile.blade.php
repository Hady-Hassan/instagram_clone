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
                               src="{{ auth()->user()->avatar != null ? \Storage::url(auth()->user()->avatar) : asset('temp/assets/no pic.jpg')}}"
                               data-holder-rendered="true">
     </div>
     <div class="col-md-8 float-start">
       <div class="row float-start "  >
           <ul class="list-inline ">
               <li class="list-inline-item me-3" ><h2 class="pt-4">{{auth()->user()->fullname}}</h2></li>
               <li class="list-inline-item me-3"><a href="{{Route('users.edit')}}" class="btn border" style="color: black"><b>Edit Profile</b></a></li>
               <li class="list-inline-item me-3"><button class="btn " ><i class="fas fa-cog" ></i></button></li>
           </ul>

       </div>
       <div class="row float-start"  >
           <ul class="list-inline " >
               <li class="list-inline-item me-5"  ><span class="list-inline-item"><b>   {{auth()->user()->posts->count()}}</b></span> posts</li>
               <li class="list-inline-item me-5"><button class="btn noHover" data-bs-toggle="modal" data-bs-target="#f1" ><span class="list-inline-item"><b>{{auth()->user()->followers->count()}}</b></span> followers</button></li>
               <li class="list-inline-item me-5"><button class="btn noHover" data-bs-toggle="modal" data-bs-target="#f2"><span class="list-inline-item"><b>{{auth()->user()->following->count()}}</b></span> following</button></li>

           </ul>
           <div style="max-height: 500px;" class="modal fade" id="f1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                 <div class="modal-content">
                   <div class="modal-header text-center">
                     <h3 class="modal-title w-100" id="exampleModalLabel" >Followers</h3>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
                       <table class="table table-borderless">
                           <tbody>
                               <tr>
                                @foreach (auth()->user()->followers as $user )




                                   <td class="align-middle"> <img src="{{ $user->avatar != null ? \Storage::url($user->avatar) : asset('temp/assets/no pic.jpg')}}"
                                           class="rounded-circle "  width="60" height="60" style="object-fit:cover ;" alt="Avatar" /></td>
                                   <td class="align-middle">
                                       <h4>{{$user->fullname}}</h4>
                                       <h6 class="text-muted">{{$user->username}}</h6>
                                   </td>
                                   <td class="align-middle ">
                                       <center><button class="btn btn-primary fw-bold  bg-gradient " onclick="removefollow({{$user->id}})"
                                               type="submit">
                                           Remove
                                           </button>
                                       </center>
                                   </td>
                               </tr>
                               @endforeach

                           </tbody>
                       </table>
                   </div>

                 </div>
               </div>
             </div>
              <div style="max-height: 500px;" class="modal fade" id="f2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                 <div class="modal-content">
                   <div class="modal-header text-center">
                     <h3 class="modal-title w-100" id="exampleModalLabel" >Following</h3>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
                       <table class="table table-borderless">
                           <tbody>
                               <tr>
                                @foreach (auth()->user()->following as $user )


                                   <td class="align-middle"> <img src="{{ $user->avatar != null ? \Storage::url($user->avatar) : asset('temp/assets/no pic.jpg')}}"
                                           class="rounded-circle "  width="60" height="60" style="object-fit:cover ;" alt="Avatar" /></td>
                                           <td class="align-middle">
                                            <h4>{{$user->fullname}}</h4>
                                            <h6 class="text-muted">{{$user->username}}</h6>
                                        </td>
                                   <td class="align-middle ">
                                       <center><button class="btn btn-primary fw-bold  bg-gradient " href="#" onclick="unfollow({{$user->id}})"
                                               type="submit">
                                           Unfollow
                                           </button>
                                       </center>
                                   </td>
                               </tr>
                               @endforeach

                           </tbody>
                       </table>
                   </div>

                 </div>
               </div>
             </div>
       </div>

    
       <div class="row float-start">
        <b>{{auth()->user()->username}}</b>
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
   </div>
   <!-- End of Header -->

<div class="container mt-4">
   <div class="row ">
       <ul class="nav nav-tabs w-100 justify-content-center ">
           <li class="nav-item ">
             <a class="nav-link active text-decoration-none text-reset"" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true" href="#"><i class="fa-solid fa-border-all "></i><span class="px-2">Posts</span></a>
           </li>

           <li class="nav-item ">
             <a class="nav-link  text-decoration-none text-reset" id="saved-tab" data-bs-toggle="tab" data-bs-target="#saved-tab-pane" type="button" role="tab" aria-controls="saved-tab-pane" aria-selected="true"><i class="fa-solid fa-bookmark"></i><span class="px-2">Saved</span></a>
           </li>

         </ul>

   </div>

</div>

    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="container my-1">

                <div class="row">
                @foreach (auth()->user()->posts as $post )
                <div class="col-md-4 ">
                    <div class="card  tag_card my-4 m-auto">
                        <div class="card-body">
                            <a href="{{ Route('post.show',['user' =>  auth()->user()->username , 'post' => $post->id  ]) }}">
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

                <div class="tab-pane fade" id="saved-tab-pane" role="tabpanel" aria-labelledby="saved-tab" tabindex="1">
            <div class="container my-1">

                <div class="row">
                @foreach (auth()->user()->savedposts() as $post )

                <div class="col-md-4 ">
                    <div class="card  tag_card my-4 m-auto">
                        <div class="card-body">
                            <a href="{{ Route('post.show',['user' =>  auth()->user()->username , 'post' => $post->post->id  ]) }}">
                            @if($post->post->media->first()->type == 'p')
                            <img src="{{ \Storage::url(  $post->post->media->first()->Path )   }}" style="max-width:100%"
                                class="col-12 w-100 m-auto"  alt="...">
                            @else
                                <video controls class="col-12 w-100 m-auto" style="max-width:100%">
                                    <source src="{{ \Storage::url(  $post->post->media->first()->Path )   }}" type="video/mp4">
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

</div>


@endsection
