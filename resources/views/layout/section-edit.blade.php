@php
    $section_count = 0;
    $lesson_count = 0;
    $quiz_count = 0;
@endphp
@foreach ($sections as $section)
    @php
        $lessons = App\Models\Lesson::where('section_id', $section->id)->get();
        $quizzes = App\Models\Quiz::where('section_id', $section->id)->get();
    @endphp
    <div class="section accordion__item" section-id="{{$section->id}}">
        <div class="btn_nav_group">
            <i onclick="addQuiz(this)" class="nav_btn add_quiz tooltip_owner fa fa-question-circle" aria-hidden="true">
                <span class="tooltiptext">Thêm Quiz</span>
            </i>
            <i onclick="addNewLesson(this)" class="nav_btn add_lesson tooltip_owner fa fa-plus-circle" aria-hidden="true">
                <span class="tooltiptext">Thêm Bài học</span>
            </i>
            <i class="nav_btn delete_section tooltip_owner fa fa-minus-circle" aria-hidden="true">
                <span class="tooltiptext">Xoá Chương</span>
            </i>
        </div>
            <a class="accordion__toggle collapsed" data-toggle="collapse" data-target="#ocourse-toc-{{$section_count}}" data-parent="#parent">
                <span class="flex editable section_name">{{$section->name}}</span>
                <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
            </a>
        <div class="accordion__menu collapse" id="ocourse-toc-{{$section_count++}}">
            @foreach ($lessons as $lesson)
                <div class="lesson" lesson-id={{$lesson->id}}>
                    <div class="accordion__menu-link" id="lesson-{{$lesson_count}}">
                        <i class="material-icons text-70 icon-16pt icon--left">drag_handle</i>
                        <a class="flex editable lesson_name">{{$lesson->name}}</a>
                        <span class="text-muted editable lesson_length">{{$lesson->duration}}</span>
                        <button type="button" class="btn ml-2 btn-blue editLesson" >Sửa</button>
                    </div>
                    <div id="lesson{{$lesson_count++}}" class="p-3 collapse">
                        <label class="form-label">Link Video/File Video</label>
                        <div class="form-group row">
                            <iframe class="m-3 mini-iframe" max-width="200%" src="{{$lesson->video_url}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                            </iframe>
                            <input type="text" class="form-control lesson_url" placeholder="URL nhúng video ..." value="{{$lesson->video_url}}">
                            <input type="file" class="form-control mt-1 video" value="Hoặc tải lên file">
                        </div>
                        
                        <div class="form-group mb-32pt">
                            <label class="form-label">Bài học</label>
                            <!--<textarea class="form-control lesson_info" rows="5" placeholder="Bài học..."></textarea>-->
                            <div id="olquill{{$lesson_count-1}}" style="height: 150px;" class="mb-0 lesson_info haveQuill" data-toggle="quill" data-quill-placeholder="Bài học...">
                                {!! $lesson->info !!}
                            </div>
                            <small class="form-text text-muted">Đọc <a href="https://viblo.asia/helps/cach-su-dung-markdown-bxjvZYnwkJZ" target="_blank">hướng dẫn </a>để sử dụng markdown</small>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach ($quizzes as $quiz)
                <div class="quiz" quiz-id="{{$quiz->id}}">
                    <div class="accordion__menu-link" id="quiz-` +count_quiz+`">
                        <i class="material-icons text-70 icon-16pt icon--left">drag_handle</i>
                        <a class="flex editable quiz_name">{{$quiz->name}}</a>
                        <button type="button" class="btn ml-2 btn-blue editQuiz" >Quiz</button>
                    </div>
                    <div id="quiz`+count_quiz++ +`" class="p-3 collapse">
                        <div class="a_quiz">
                            <div class="form-group mb-32pt">
                                <label class="form-label">Câu hỏi</label>
                                <!-- <textarea class="form-control quiz_question" rows="3" placeholder="Câu hỏi..."></textarea> -->
                                <div id="oqquill{{$quiz_count++}}" style="height: 100px;" class="mb-0 quiz_question haveQuill" data-toggle="quill" data-quill-placeholder="Câu hỏi...">
                                    {!! $quiz->question !!}
                                </div>
                                <small class="form-text text-muted">Đọc <a href="https://viblo.asia/helps/cach-su-dung-markdown-bxjvZYnwkJZ" target="_blank">hướng dẫn </a>để sử dụng markdown</small>
                            </div>
                                @php
                                    $answers = App\Models\Answer::where('quiz_id', $quiz->id)->get();
                                @endphp
                                @foreach ($answers as $answer)
                                <div answer-id="{{$answer->id}}" class="quiz_answer form-row col-md-12 col-sm-12 ml-2 mt-2">

                                    <div class="ml-3 tooltip_owner">
                                        <input type="checkbox" class="form-check-input isAnswer" value="answer" {{($answer->is_true==1)?'checked':''}}>
                                        <span class="tooltiptext">Câu trả lời đúng</span>    
                                    </div>
                                    <div class="ml-1 col-md-8 col-sm-8">
                                        <input type="text" class="form-control ans_content" required placeholder="Câu trả lời ..." value="{{$answer->content}}">
                                    </div>
                                    <button type="button" class="btn btn-success" id="add_answer"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                    <button type="button" class="btn btn-danger rm_skill ml-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                </div>
                                @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach