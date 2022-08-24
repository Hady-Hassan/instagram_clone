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