
@extends('layouts.default')
@section('page_title', 'Home')

@section('content')
<div class="container mb-3" style="height: 90vh;">
      <div class="row h-100">
        <div class="col-6 p-0 pb-4 pt-4 " style="background-color:#000;" >
            <div id="second-carousel" class="carousel slide h-100 " data-bs-ride="false" >
                <div class="second-carousel carousel-inner ">
                  <!-- Post Pic/video -->
                  @foreach($post->media as $media)

                <div  @class(['carousel-item',' h-100','active' => $loop->first])>
                        @if($media->type == 'p')
                            <img src="{{ \Storage::url(  $media->Path )   }}" class="col-12" style="height:650px;" alt="...">
                        @else
                            <video controls class="col-12 h-100">
                                <source src="{{ \Storage::url(  $media->Path )   }}" style="height:650px;" type="video/mp4">
                            </video>
                        @endif
                    </div>
                @endforeach
              </div>
              @if($post->media->count() !== 1)
              <button class="carousel-control-prev" type="button" data-bs-target="#second-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#second-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"  aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
              @endif
            </div>
        </div>
        <div class="col-6 p-0">
            <div class="card h-100" style="border-radius:0">
                <div class="card-header">
                  <div class="container-fluid p-1">
                    <div class="row">
                      <div class="col-1 m-auto">
                        <a
                        href="{{ Route('users.show',['user' => $post->user->username]) }}"
                        class="d-block link-dark text-decoration-none"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                      >
                        <img
                          src="{{   $post->user->avatar  != null ? \Storage::url(  $post->user->avatar ) : asset('temp/assets/no pic.jpg')}}"
                          alt="mdo"
                          width="42"
                          height="42"
                          class="rounded-circle"
                        />
                      </a>
                      </div>
                      <div class="col-11 m-auto">
                        <div class="row ">
                          <!-- Username -->
                          <small class="col-4 my-auto"  style="font-size:18px; font-weight: 500;font-weight:500;">{{$post->user->username}}</small>
                          <button class="col-2 btn btn-primary" style="border-radius: 5px;">Follow</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body p-0" style="height:400px ; overflow-y: scroll;">
                  <!-- Caption -->
                  <div class="container-fluid  mb-3 pb-1 sticky-top" style="background-color:#fff;border-bottom:1px solid #ccc;">
                    <div class="row p-2">
                      <div class="col-1 m-auto">
                        <a
                        href="#"
                        class="d-block link-dark text-decoration-none"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                      >
                        <img
                        src="{{   $post->user->avatar  != null ? \Storage::url(  $post->user->avatar ) : asset('temp/assets/no pic.jpg')}}"
                          alt="mdo"
                          width="42"
                          height="42"
                          class="rounded-circle"
                        />
                      </a>
                      </div>
                      <div class="col-11 m-auto">
                        <div class="row ">
                          <!-- Username -->
                          <small class="col-11 my-auto"  style="font-size:18px; font-weight: 500;font-weight:500;">{{ $post->user->username }}</small>
                        </div>
                      </div>
                    </div>
                    <div class="row"  >
                      
                      <div class="col-11 ms-auto">
                      {!!  $post->caption !!}
                      </div>
                    </div>
                    <div class="row text-muted mb-2">
                      <div class="col-2 ms-auto">{{ $post->created_at->diffForHumans(); }}</div>
                    </div>
                      </div>
                      <!-- End Caption -->



                       <!-- Comment -->
                  @foreach($post->comments as $comment)    
                  <div class="container-fluid  my-1" >
                    <div class="row p-2">
                      <div class="col-1 m-auto">
                        <a
                        href="#"
                        class="d-block link-dark text-decoration-none"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                      >
                        <img
                        src="{{  $comment->user->avatar  != null ? \Storage::url(  $comment->user->avatar ) : asset('temp/assets/no pic.jpg')}}"
                          alt="mdo"
                          width="42"
                          height="42"
                          class="rounded-circle"
                        />
                      </a>
                      </div>
                      <div class="col-11 m-auto">
                        <div class="row ">
                          <!-- Username -->
                          <small class="col-11 my-auto"  style="font-size:18px; font-weight: 500;font-weight:500;">{{$comment->user->username}}</small>
                          <form action="POST" class="col-1 mt-auto">
                          <input type="checkbox" class="liked" name="like" id="comment_{{$comment->id}}" />
                          <label for="comment_{{$comment->id}}" class="col-1 opacity-100" >
                            <svg id="like-svg" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="lightgray" class="bi bi-heart-fill" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                            </svg>
                        </label>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="row"  >
                      
                      <div class="col-11 ms-auto">
                      {{$comment->content}}
                      </div>
                    </div>
                    <div class="row text-muted mb-2">
                      <div class="col-2 ms-auto" style="font-size:12px;">{{ $comment->created_at->diffForHumans(); }}</div>
                    </div>
                      </div>
                      @endforeach
                      <!-- End comments -->
                </div>



                <div class="card-footer text-muted">
                  <div class="row">    
                   
                    <!-- Like button -->
                    <div class="col-1 p-0 ">
                      <!-- Like form -->
                      <form method="POST">
                      <input type="checkbox" class="heart" id="heart" name="like"/>
                    <label for="heart" class="opacity-100">
                      <svg id="heart-svg" viewBox="467 392 58 57" xmlns="http://www.w3.org/2000/svg" >
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
                      <input type="checkbox" class="saved" id="saved" name="saved"/>
                      <label for="saved" class="opacity-100">
                        <svg xmlns="http://www.w3.org/2000/svg" id="saved-svg" fill="gray"  class="bi bi-bookmark" viewBox="0 0 16 16">
                          <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                        </svg>
                      </label>
                    </form>
                    <!-- End save form -->
                  </div>
                  <div style="font-size:16px;font-weight:500;">{{ $post->likes->count() }} likes</div>
                  </div>
                  
                </div>
                <div class="card-footer text-muted container-fluid p-0">
                    <!-- Comment form -->
                    <div class="row p-0">
                      <div class="col-10 ">
                          <textarea cols="45" rows="1" class="form-control" id="comment"  name="comment" placeholder="write your comment.." style="border-radius: 0; font-size: 16px;"></textarea>
                      </div>
                      <div class="col-2 m-auto">
                        <input type="submit" value="POST" class="btn btn-default" style="color:#3cacfc; font-weight:500;border-radius: 0;">
                      </div>
                    <!-- End Comment Form -->
                  </div>
                </div>
              </div>
        </div>
      </div>
    </div>

@endsection