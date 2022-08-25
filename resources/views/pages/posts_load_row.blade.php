
@foreach($posts as $post)

<div class="container my-4 text-center px-5">
    <div class="row">
        <div class="p-5 bg-light rounded-3">
        <div class="container-fluid">
            <h1 class="display-5 fw-bold">#{{$tag}}</h1>
        </div>
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
                        <video controls class="col-12 w-100 m-auto" style="max-width:100%">
                            <source src="{{ \Storage::url($post->media->first()->Path) }}  " type="video/mp4">
                        </video>
                    @endif
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endforeach
