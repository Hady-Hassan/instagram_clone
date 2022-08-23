
@foreach($users as $user)
<li class="p-2 dropdown-item" > 
    <div class="row">
        <div class="col-2"><img src="{{ $user->avatar != null ? \Storage::url($user->avatar) : asset("temp/assets/no pic.jpg") }} "  alt="mdo"  width="28"  height="28" style="object-fit:cover ;" class="rounded-circle" /></div>
        <div class="col-10"><a href="{{ Route('users.show',['user'=>$user->username]) }}">{{$user->fullname}}</a></div>
    </div>
</li>

@endforeach