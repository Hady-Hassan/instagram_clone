@extends('layouts.default')
@section('page_title', 'Edit Post')



@section('content')

<div class="container mb-3" style="height: 90vh;">
  <div class="row h-100">
    <div class="col-6 p-0 pb-4 pt-4 " style="background-color:#000;">
      <div id="second-carousel" class="carousel slide h-100 " data-bs-ride="false">
        <div class="second-carousel carousel-inner ">
          <!-- Post Pic/video -->
          @foreach($post->media as $media)

          <div @class(['carousel-item',' h-100','active'=> $loop->first])>
            @if($media->type == 'p')
            <img src="{{ \Storage::url(  $media->Path )   }}" class="col-12" style="height:650px;" alt="...">
            @else
            <video controls class="col-12" style="height:650px;margin:auto;">
              <source src="{{ \Storage::url(  $media->Path )   }}" type="video/mp4">
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
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
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
                <a href="{{ Route('users.show',['user' => $post->user->username]) }}" class="d-block link-dark text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="{{   $post->user->avatar  != null ? \Storage::url(  $post->user->avatar ) : asset('temp/assets/no pic.jpg')}}" alt="mdo" width="42" height="42" class="rounded-circle " style="object-fit: cover" />
                </a>
              </div>
              <div class="col-11 m-auto">
                <div class="row ">
                  <!-- Username -->
                  <small class="col-4 my-auto" style="font-size:18px; font-weight: 500;font-weight:500;">{{$post->user->username}}</small>
                  <div class="col-2">
             

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body p-0" style="height:400px ; overflow-y: scroll;" id="last_comment_section_{{$post->id}}">
          <!-- Caption -->
          <div class="container-fluid  mb-3 pb-1 sticky-top" style="background-color:#fff;border-bottom:1px solid #ccc;">

            <div class="row">

              <form method="Post" action="{{route('post.update',['id'=>$post->id])}}">
                @method('PUT')
                @csrf
                <textarea name="caption" id="" cols="80" rows="10">{{ $post->caption}}</textarea>
                <center>
                  <button class="btn btn-primary" type="submit">
                    Save
                  </button>
                </center>

              </form>

            </div>
            <div class="row text-muted mb-2">
              <div class="col-2 ms-auto">{{ $post->created_at->diffForHumans(); }}</div>
            </div>
          </div>
          <!-- End Caption -->

        </div>



        <div class="card-footer text-muted">
          <div class="row">


            <div class="col-1 p-0 mt-auto mb-auto">


            </div>
          </div>
        </div>



        @endsection