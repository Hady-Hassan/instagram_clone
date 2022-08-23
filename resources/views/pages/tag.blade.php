@extends('layouts.default')
@section('page_title', 'Home')

@section('content')

<div class="container my-4 text-center px-5">
    <div class="row">
        <div class="col-md-6">
            <h2>#{{$tag}}</h2>
        </div>
    </div>
    <!-- End of Header -->
    <div class="row">
        @foreach($posts as $post)
        <div class="col-md-4 my-5">
            <div class="card  tag_card my-4 m-auto">
                <div class="card-body">
                    
                    <a href="{{ Route('post.show',['user' =>  $post->user->username , 'post' => $post->id  ]) }}">
                        @if($post->media->first()->type == 'p')
                        <img src="{{ \Storage::url($post->media->first()->Path)   }}" style="max-width:100%"
                            class="col-12 w-100 m-auto" alt="">
                        @else
                        <video controls class="col-12 w-100 m-auto" tyle="max-width:100%">
                            <source src="{{ \Storage::url($post->media->first()->Path)   " type="video/mp4">
                        </video>
                    @endif
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
