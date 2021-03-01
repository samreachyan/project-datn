@foreach ($hotCourses as $course)
<div class="list-group-item d-flex flex-column flex-sm-row align-items-sm-center px-12pt">
    <div class="flex d-flex align-items-center mr-sm-16pt mb-8pt mb-sm-0">
        <a href="/student/course-preview/{{ $course->id }}" class="avatar overlay overlay--primary avatar-4by3 mr-12pt">
            <img src="{{ $course ->thumbnail_url }}" alt="Newsletter Design" class="avatar-img rounded">
            <span class="overlay__content"></span>
        </a>
        <div class="flex">
            <a class="card-title mb-4pt" href="/student/course-preview/{{ $course->id }}">{{ $course->name }}</a>
        </div>
    </div>
    <div class="d-flex align-items-center">
        <div class="flex text-center d-flex align-items-center mr-16pt">
            <span style="font-size: 13px" class="card-title text-muted">{{$course['students_count']}}</span>
            <i style="font-size: 16px" class="material-icons text-muted ml-2">remove_red_eye</i>
        </div>

    </div>
</div>
@endforeach