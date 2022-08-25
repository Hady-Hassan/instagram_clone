
@extends('layouts.default')
@section('page_title', 'Home')

@section('content')
<div id="wrapper">
@foreach($posts as $post)

<div class="card w-50 my-4 m-auto">   
        <div class="card-header pt-3">
          <div class="container-fluid p-0">
            <div class="row">
              <div class="col-1 m-auto">
                <a
                href="#"
                class="d-block link-dark text-decoration-none"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
              <a href="{{ Route('users.show',['user' => $post->user->username]) }}"><img
                src="{{   $post->user->avatar  != null ? \Storage::url(  $post->user->avatar ) : asset('temp/assets/no pic.jpg')}}"
                  alt="mdo"
                  width="28"
                  height="28"
                  class="rounded-circle"
                />
              </a>
              </div>
              <div class="col-11 m-auto">
                <div class="row ">
                  <!-- Name -->
                <a href="{{ Route('users.show',['user' => $post->user->username]) }}"><small>{{  $post->user->fullname }}</small></a>
                  
                </div>
                <div class="row">
                  <!-- Username -->
                  <a href="{{ Route('users.show',['user' => $post->user->username]) }}"><small class="text-muted" style="font-size:10px;"> {{  "@".$post->user->username }}</small></a>
                </div>
              </div>
            </div>
          </div>
         
        </div>
        <div class="card-body">
          <!-- Slide -->
          <div id="second-carousel_{{$post->id}}" class="carousel carousel-first slide  w-100" data-bs-ride="false">
            <div class="second-carousel carousel-inner ">
              <!-- Post Pic/video -->   

              @foreach($post->media as $media)
                <div  @class(['carousel-item','active' => $loop->first])>
                        @if($media->type == 'p')
                            <img src="{{ \Storage::url(  $media->Path )   }}" class="col-12 w-100 m-auto"  alt="...">
                        @else
                            <video controls class="col-12 w-100 m-auto">
                                <source src="{{ \Storage::url(  $media->Path )   }}" type="video/mp4">
                            </video>
                        @endif
                    </div>
                @endforeach
          </div>
          @if($post->media->count() !== 1)
          <button class="carousel-control-prev" type="button" data-bs-target="#second-carousel_{{$post->id}}" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#second-carousel_{{$post->id}}" data-bs-slide="next">
            <span class="carousel-control-next-icon"  aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
          @endif
        </div>
        <!-- End Slide -->
        <div class="container-fluid mt-2">
          <div class="row">
            <!-- Like button -->
            <div class="col-1 p-0 ">
              <!-- Like form -->
              <form method="POST">
              <input type="checkbox" class="heart" {{ $post->isLiked() ? "checked" : " " }} id="heart" name="heart_{{ $post->id }}" value="heart_{{ $post->id }}"/>
              <label  for="heart_{{ $post->id }}" data-action="like" data-postid="{{ $post->id }}" class="opacity-100" onclick="toggle(this)">
              <svg id="heart-svg" viewBox="467 392 58 57" xmlns="http://www.w3.org/2000/svg">
                <g id="Group" fill="none" fill-rule="evenodd" transform="translate(467 392)">
                  <path d="M29.144 20.773c-.063-.13-4.227-8.67-11.44-2.59C7.63 28.795 28.94 43.256 29.143 43.394c.204-.138 21.513-14.6 11.44-25.213-7.214-6.08-11.377 2.46-11.44 2.59z" id="heart" fill="#AAB8C2"/>
                  <circle id="main-circ" fill="#E2264D" opacity="0" cx="29.5" cy="29.5" r="1.5"/>
        
                  <g id="heartgroup7" opacity="0" transform="translate(7 6)">
                    <circle id="heart1" fill="#9CD8C3" cx="2" cy="6" r="2"/>
                    <circle id="heart2" fill="#8CE8C3" cx="5" cy="2" r="2"/>
                  </g>
        
                  <g id="heartgroup6" opacity="0" transform="translate(0 28)">
                    <circle id="heart1" fill="#CC8EF5" cx="2" cy="7" r="2"/>
                    <circle id="heart2" fill="#91D2FA" cx="3" cy="2" r="2"/>
                  </g>
        
                  <g id="heartgroup3" opacity="0" transform="translate(52 28)">
                    <circle id="heart2" fill="#9CD8C3" cx="2" cy="7" r="2"/>
                    <circle id="heart1" fill="#8CE8C3" cx="4" cy="2" r="2"/>
                  </g>
        
                  <g id="heartgroup2" opacity="0" transform="translate(44 6)">
                    <circle id="heart2" fill="#CC8EF5" cx="5" cy="6" r="2"/>
                    <circle id="heart1" fill="#CC8EF5" cx="2" cy="2" r="2"/>
                  </g>
        
                  <g id="heartgroup5" opacity="0" transform="translate(14 50)">
                    <circle id="heart1" fill="#91D2FA" cx="6" cy="5" r="2"/>
                    <circle id="heart2" fill="#91D2FA" cx="2" cy="2" r="2"/>
                  </g>
        
                  <g id="heartgroup4" opacity="0" transform="translate(35 50)">
                    <circle id="heart1" fill="#F48EA7" cx="6" cy="5" r="2"/>
                    <circle id="heart2" fill="#F48EA7" cx="2" cy="2" r="2"/>
                  </g>
        
                  <g id="heartgroup1" opacity="0" transform="translate(24)">
                    <circle id="heart1" fill="#9FC7FA" cx="2.5" cy="3" r="2"/>
                    <circle id="heart2" fill="#9FC7FA" cx="7.5" cy="2" r="2"/>
                  </g>
                </g>
              </svg>
            </label>
          </form>
           <!-- End Like form -->
            </div>
             <!--End Like button -->
            <div class="col-1 p-0 mt-auto mb-auto">
              <!-- Save form -->
              <form method="POST">
              <input type="checkbox" class="saved" {{ $post->isSaved() ? "checked" : " " }} id="saved" name="save_{{ $post->id }}" value="save_{{ $post->id }}"/>
              <label for="save_{{ $post->id }}" data-action="save" data-postid="{{ $post->id }}"  class="opacity-100" onclick = "toggle(this)">
                <svg xmlns="http://www.w3.org/2000/svg" id="saved-svg" fill="gray"  class="bi bi-bookmark" viewBox="0 0 16 16">
                  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                </svg>
              </label>
            </form>
            <!-- End save form -->
          </div>
          </div>
          <!-- Number of Likes -->
          <div class="container-fluid p-0 mt-1 mb-1">
            <div class="row">
              <strong class="col-12">{{ $post->likes->count() }} likes</strong>
            </div>
          </div>
          <!-- End Number of Likes-->
          <!-- Caption -->
          <div class="container-fluid p-0">
            <div class="row">
            <small class="col-12"><strong class="me-1"><b><a href="{{ Route('users.show',['user' => $post->user->username]) }}">{{ $post->user->username }}</a></b> </strong><strong> {!!  $post->caption !!}</strong></small>
            </div>
          </div>

          <!-- End Caption -->
          <div class="container-fluid p-0 mt-2 ">
            <div class="row last_comment_section" id="last_comment_section_{{ $post->id }}">
                @foreach($post->lastComments as $comment)
                    <small class="col-12  commenting"> <a href="{{ Route('users.show',['user' => $comment->user->username]) }}"> <strong class="me-1">{{$comment->user->username}}</strong> </a> {{$comment->content}}</small>
                @endforeach
            </div>
            
            <div class="row text-muted view_comments" data-id="{{ $post->id }}" >
             <a class=" my-3 text-muted" href="{{ Route('post.show',['user' =>  $post->user->username , 'post' => $post->id  ]) }}">View all comments</a>
            </div>
            <small class=" my-3 text-muted"> {{ $post->created_at->diffForHumans(); }}</small>
          </div>
          <div class="container-fluid p-0 mt-2">
              <!-- Comment form -->
              <form data-postid="{{ $post->id }}" class="comment_post" name="comment_post" id="comment_post_{{ $post->id }}" method="POST" action="{{ Route('post.make_comment',['user' =>  $post->user->username , 'post' => $post->id  ]) }}">
              <div class="row">
                <div class="col-10 ">
                    <textarea cols="40" rows="1" class="form-control" id="comment"  name="comment" placeholder="write your comment.."></textarea>
                </div>
                <div class="col-2">
                  <input type="submit" value="POST" class="btn btn-default">
                </div>
                </div>
              </form>
              <!-- End Comment Form -->
          </div>
        </div>
        </div>
      </div>
  

@endforeach
  </div>  
  <div class="container">
     <div class="ajax-loading  text-center" ><img src="{{asset('temp/assets/loading.gif')}}" /></div>
  </div>
@endsection

@section('more_js')
  @include('scripts.ajax_posts_load_more')
@endsection