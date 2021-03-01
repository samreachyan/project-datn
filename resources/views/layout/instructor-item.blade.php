@foreach ($instructors as $instructor)
<div class="col-md-3 col-xl-4 card-group-row__col">
    <div class="card card-group-row__card">
        <a href="{{route('get_user_home', ['username' => $instructor->username])}}" class="card-header d-flex align-items-center">
            <div style="width: 40px" class="mr-2">
                <img src="{{$instructor->avatar_url}}" alt="avatar" class="circle-ava">
            </div>
            <div>
                <p class="card-title flex mr-12pt">{{$instructor->name}}</p>
                <p class="card-title flex mr-12pt text-muted">(@ {{$instructor->username}})</p>
            </div>
        </a>

    </div>
</div>    
@endforeach