@extends('layout.app')
{{-- @section('menu_button', 'd-lg-none') --}}
@section('content')
@php
    $courses = App\Models\Course::withCount('students')->where('instructor_id', $account->id)->get();
@endphp
<div class="page-section bg-primary">
    @csrf
    <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-md-left">
        @if ($account->avatar_url)
            <img src="{!!asset($account->avatar_url) .'?'. time() !!}" width="104" height="104" class="mr-md-32pt mb-32pt mb-md-0 circle-img" alt="instructor">
        @else
            <img src="assets/images/illustration/teacher/128/white.svg" width="104" class="mr-md-32pt mb-32pt mb-md-0" alt="instructor">
        @endif
        <div class="flex mb-32pt mb-md-0">
            <h2 class="text-white mb-0">{{$account->name}}</h2>
            <p class="lead text-white-50 d-flex align-items-center">Giảng viên</p>
        </div>
        <div style="text-align: end">
            @if (App\Models\Student::find(Auth::user()->id)->isFollowing($account->id))
                <a instructor-id={{$account->id}} class="btn btn-outline-white whiteButton blackHover follow">Bỏ theo dõi</a>
            @else
                <a instructor-id={{$account->id}} class="btn btn-outline-white whiteButton blackHover follow">Theo dõi</a>
            @endif
            <p class="lead text-white-50 align-items-center mt-1" style="font-size: 0.75rem"><span class="text-white" style="opacity:0.8">{{App\Models\Instructor::find($account->id)->followers()->count()}}</span> người theo dõi</p>
        </div>
    </div>
</div>

<div class="page-section bg-white border-bottom-2">
    <div class="container page__container">
        <div class="row">
            <div class="col-md-8">
                <h4>Giới thiệu</h4>
                <div>
                    {!! $instructor->introduce !!}
                </div>
            </div>
            <div class="col-md-3">
                <h4>Liên kết</h4>
                <div class="d-flex align-items-center">
                    <a href="" class="text-accent fab fa-facebook-square font-size-24pt mr-8pt"></a>
                    <a href="" class="text-accent fab fa-twitter-square font-size-24pt"></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container page__container page-section">

    <div class="page-headline text-center">
        <h2>Khoá học của tôi</h2>
        <p class="lead text-70 col-lg-8 mx-auto">{{$account->username}}</p>
    </div>

    <div class="row card-group-row mb-8pt">
        @include('layout.simple-course-item');
    </div>
@endsection

@section('active-dashboard', 'active')