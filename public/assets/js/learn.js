var currentLearn = course.sections[0].lessons[0];
var userAnswers = [];
function clearView(){
    $('.viewlesson').each(function(){
        $(this).removeClass('active');
    })
    $('.viewquiz').each(function(){
        $(this).removeClass('active');
    })
    $('.selectsection').each(function(){
        $(this).removeClass('active');
    })
}

function getSection(section_id){
    rs = null;
    course.sections.forEach(section => {
        if(section.id == section_id) rs = section
    });
    return rs;
}
function getNextSection(section_id){
    for (let index = 0; index < course.sections.length; index++) {
        const section = course.sections[index];
        if(section.id == section_id){
            return course.sections[index + 1];
        }
    }
}
function getPrevSection(section_id){
    for (let index = 0; index < course.sections.length; index++) {
        const section = course.sections[index];
        if(section.id == section_id){
            return course.sections[index - 1];
        }
    }
}
function getLesson(lesson_id){
    rs = null;
    course.sections.forEach(section => {
        section.lessons.forEach(lesson => {
            if(lesson.id == lesson_id) rs = lesson
        })
    });
    return rs;
}

function getLesson(section_id, lesson_id){
    rs = null;
    course.sections.forEach(section => {
        if (section.id == section_id) {
            section.lessons.forEach(lesson => {
                if(lesson.id == lesson_id) 
                    rs = lesson;
            });
        }
    });
    return rs;
}
function getNextLesson(lesson_id){
    rs = null
    course.sections.forEach(section => {
        if (section.id == currentLearn.section_id) {
            lessonNumber = section.lessons.length;
            for (let index = 0; index < lessonNumber; index++) {
                const q = section.lessons[index];
                if(q.id == lesson_id){
                    rs = section.lessons[index + 1];
                    break;
                }
            }
        }
    });
    return rs;
}
function getPrevLesson(lesson_id){
    rs = null
    course.sections.forEach(section => {
        if (section.id == currentLearn.section_id) {
            lessonNumber = section.lessons.length;
            for (let index = 0; index < lessonNumber; index++) {
                const q = section.lessons[index];
                if(q.id == lesson_id){
                    rs = section.lessons[index - 1];
                    break;
                }
            }
        }
    });
    return rs;
}

function getFirstQuiz(section){
    return section.quizzes[0];
}

// function getQuiz(quiz_id){
//     rs = null;
//     course.sections.forEach(section => {
//         section.quizzes.forEach(quiz => {
//             if(quiz.id == quiz_id) rs = quiz
//         })
//     });
//     return rs;
// }
function getNextQuiz(quiz_id){
    rs = null
    debugger
    course.sections.forEach(section => {
        if (section.id == currentLearn.section_id) {
            quizNumber = section.quizzes.length;
            for (let index = 0; index < quizNumber; index++) {
                const q = section.quizzes[index];
                if(q.id == quiz_id){
                    rs = section.quizzes[index + 1];
                    break;
                }
            }
        }
    });
    return rs;
}
function getPrevQuiz(quiz_id){
    rs = null;
    course.sections.forEach(section => {
        if (section.id == currentLearn.section_id) {
            quizNumber = section.quizzes.length;
            for (let index = 0; index < quizNumber; index++) {
                const q = section.quizzes[index];
                if(q.id == quiz_id){
                    rs = section.quizzes[index - 1];
                    break;
                }
            }
        }
    });
    return rs;
}

function getQuiz(section_id, quiz_id){
    rs = null;
    course.sections.forEach(section => {
        if (section.id == section_id) {
            section.quizzes.forEach(quiz => {
                if(quiz.id == quiz_id) 
                    rs = quiz;
            });
        }
    });
    return rs;
}

function fillViewWithLesson(section_id, lesson_id){
    $('.course-nav a span').each(function(){
        if($(this).attr('sid') == section_id) $(this).addClass('text-primary');
        else $(this).removeClass('text-primary');
    });
    lesson = getLesson(section_id, lesson_id);
    currentLearn = lesson;
    currentLearn.type = 'lesson';
    $('#lesson-name').text(lesson.name);
    $('#lesson-duration').text(lesson.duration);
    $('#lesson-info').html(lesson.info);
    if(lesson.video_url){
        $('#featured-video').attr('src', lesson.video_url);
        $('#video-container').removeClass('video-gone');
    }else{
        $('#video-container').addClass('video-gone');
    }
    lessonInSectionCheckPoint();
}
function fillViewWithQuiz(section_id, quiz_id){
    $('.course-nav a span').each(function(){
        if($(this).attr('sid') == section_id) $(this).addClass('text-primary');
        else $(this).removeClass('text-primary');
    });
    quiz = null;
    quizIndex = 0;
    quizNumber = 0;
    course.sections.forEach(section => {
        if (section.id == section_id) {
            quizNumber = section.quizzes.length;
            for (let index = 0; index < quizNumber; index++) {
                const q = section.quizzes[index];
                if(q.id == quiz_id){
                    quiz = q;
                    quizIndex = index + 1;
                    break;
                }
            }
        }
    });
    currentLearn = quiz;
    currentLearn.type = 'quiz';
    $('#quiz-number').text("Câu hỏi " + quizIndex + " trong " + quizNumber);

    if(quizIndex == quizNumber){
        $('.next-quiz').html('Chấm điểm <i class="material-icons icon--right">keyboard_arrow_right</i>');
    }
    else{
        $('.next-quiz').html('Câu hỏi tiếp theo <i class="material-icons icon--right">keyboard_arrow_right</i>');
    }
    if(quizIndex == 1){
        $('.prev-quiz').hide();
    }else{
        $('.prev-quiz').show();
    }
    
    $('#quiz-question').html(quiz.question);
    var countTrueAnswer = 0;
    quiz.answers.forEach(answer => {
        if(answer.is_true) countTrueAnswer += 1;
    })
    answerPane = $('.answer_pane');
    var inerhtml = "";
    answerIndex = 0;
    if(countTrueAnswer > 1){
        quiz.answers.forEach(answer => {
            checked = '';
            if(userAnswers[currentLearn.id]){
                if (userAnswers[currentLearn.id].includes(answerIndex)) checked = 'checked';
            }
            inerhtml += `
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input id="customCheck`+answer.id+`" type="checkbox" class="custom-control-input" `+checked+`>
                    <label answer-id=`+answer.id+` for="customCheck`+answer.id+`" class="custom-control-label">`+answer.content+`</label>
                </div>
            </div>`;
            answerIndex += 1;
        })
    }else{
        quiz.answers.forEach(answer => {
            checked = '';
            if(userAnswers[currentLearn.id]){
                if (userAnswers[currentLearn.id].includes(answerIndex)) checked = 'checked';
            }
            inerhtml += `
            <div class="form-group">
                <div class="custom-control custom-radio">
                    <input name="answer" id="customCheck`+answer.id+`" type="radio" class="custom-control-input" `+checked+`>
                    <label answer-id=`+answer.id+` for="customCheck`+answer.id+`" class="custom-control-label">`+answer.content+`</label>
                </div>
            </div>`;
            answerIndex += 1;
        })
    }
    answerPane.html(inerhtml);
}

$(document).on('click', '.viewlesson', function(e){
    e.preventDefault();
    // debugger
    lesson_id = $(this).attr('lesson-id');
    if(currentLearn.type != 'lesson' || currentLearn.id != lesson_id){
        removeAllActiveContent();
        $("#lesson-view").addClass("active");
        clearView();
        $(this).addClass('active');
        $(this).parent().parent().addClass('active');
        fillViewWithLesson($(this).parent().parent().attr('section-id'), lesson_id);
    }
})
$(document).on('click', '.viewquiz', function(e){
    e.preventDefault();
    section_id = $(this).parent().parent().attr('section-id');
    section = getSection(section_id);
    if(currentLearn.type != 'quiz' || section_id != currentLearn.section_id){
        debugger
        if(!section.students[0] || !section.students[0].pivot || !section.students[0].pivot.highest_point){
            userAnswers = [];
            removeAllActiveContent();
            $("#quiz-view").addClass("active");
            clearView();
            $(this).addClass('active');
            $(this).parent().parent().addClass('active');
            fillViewWithQuiz(section_id, getSection(section_id).quizzes[0].id);
        }else{
            removeAllActiveContent();
            $("#quiz-result").addClass("active");
            $(".result-container").html('');
            // quizIndex = 1;
            // section.quizzes.forEach(quiz=>{
            //     debugger
            //     var answerContainer = `
            //     <div class="border-left-2 page-section pl-32pt">

            //         <div class="d-flex align-items-center page-num-container mb-16pt">
            //             <div class="page-num">`+quizIndex+`</div>
            //             <h4>`+quiz.name+`</h4>
            //         </div>

            //         <div class="text-70 measure-lead mb-32pt mb-lg-48pt">`+ quiz.question +`</div>

            //         <ul id="list-quiz`+quiz.id+`" class="list-quiz">
            //         </ul>
            //     </div>`;
            //     $(".result-container").append(answerContainer);
            //     quizId = quiz.id;
            //     answerIndex = 0;
            //     rightAnswer = true;
            //     quiz.answers.forEach(ans => {
            //         isTrue = ans.is_true == 1;
            //         // debugger
            //         var spanDeco = `<span class="list-quiz-badge"></span>`;
            //         if(isTrue) spanDeco = `<span class="list-quiz-badge bg-primary text-white"><i class="material-icons">check</i></span>`;
            //         var active = '';
            //         if(isTrue) active = 'active';
            //         var answerTemplate = `                    
            //         <li class="list-quiz-item `+active+`">
            //             `+spanDeco+`
            //             <span class="list-quiz-text">`+ans.content+`</span>
            //         </li>`;

            //         $("#list-quiz"+quiz.id).append(answerTemplate);
            //         answerIndex += 1;
            //     })
            //     quizIndex += 1;
            // });
            $('.small-point').html(`<i class="material-icons text-muted icon--left">assessment</i>`+(section.students[0].pivot.highest_point) + `/` + 100 + ` Điểm`);
            $('.large-point').html(`Điểm cao nhất: ` + section.students[0].pivot.highest_point + ` điểm`);
        }
    } 
})

function openLesson(lesson_id){
    $(".viewlesson[lesson-id='"+lesson_id+"']").trigger("click");
}

$(document).on('click', '.next-quiz', function(e){
    e.preventDefault();
    console.log($(this).text());
    if($(this).text().includes("Câu hỏi tiếp theo")){
        quiz = getNextQuiz(currentLearn.id);
        // debugger
        if(!quiz){
            
        }else{
            userAnswers[currentLearn.id] = [];
            answers = document.getElementsByClassName('answer_pane')[0].getElementsByTagName('input');
            for (let index = 0; index < answers.length; index++) {
                const answer = answers[index];
                if(answer.checked) userAnswers[currentLearn.id].push(index);
            }
            // console.log(userAnswers[currentLearn.id]);
            fillViewWithQuiz(quiz.section_id, quiz.id);
        }
    }else{
        removeAllActiveContent();
        $("#quiz-result").addClass("active");
        point = 0;
        section = getSection(currentLearn.section_id);
        numberOfQuiz = section.quizzes.length;
        // console.log(currentLearn);
        // console.log(section);
        userAnswers[currentLearn.id] = [];
        answers = document.getElementsByClassName('answer_pane')[0].getElementsByTagName('input');
        for (let index = 0; index < answers.length; index++) {
            const answer = answers[index];
            if(answer.checked) userAnswers[currentLearn.id].push(index);
        }
        quizIndex = 1;
        $(".result-container").html('');
        section.quizzes.forEach(quiz=>{
            var answerContainer = `
            <div class="border-left-2 page-section pl-32pt">

                <div class="d-flex align-items-center page-num-container mb-16pt">
                    <div class="page-num">`+quizIndex+`</div>
                    <h4>`+quiz.name+`</h4>
                </div>

                <div class="text-70 measure-lead mb-32pt mb-lg-48pt">`+ quiz.question +`</div>

                <ul id="list-quiz`+quiz.id+`" class="list-quiz">
                </ul>
            </div>`;
            $(".result-container").append(answerContainer);
            quizId = quiz.id;
            answerIndex = 0;
            rightAnswer = true;
            quiz.answers.forEach(ans => {
                isTrue = ans.is_true == 1;
                // debugger
                if((isTrue && !userAnswers[quizId].includes(answerIndex)) || (!isTrue && userAnswers[quizId].includes(answerIndex))){
                    rightAnswer = false;
                }
                var spanDeco = `<span class="list-quiz-badge"></span>`;
                if(isTrue && !userAnswers[quizId].includes(answerIndex)) spanDeco = `<span class="list-quiz-badge bg-primary text-white"><i class="material-icons">check</i></span>`
                else if(isTrue && userAnswers[quizId].includes(answerIndex)) spanDeco = `<span class="list-quiz-badge bg-success text-white"><i class="material-icons">check</i></span>`
                else if(!isTrue && userAnswers[quizId].includes(answerIndex))  spanDeco = `<span class="list-quiz-badge bg-danger text-white"><i class="fa fa-times" aria-hidden="true"></i></span>`;
                var active = '';
                if(isTrue) active = 'active';
                var answerTemplate = `                    
                <li class="list-quiz-item `+active+`">
                    `+spanDeco+`
                    <span class="list-quiz-text">`+ans.content+`</span>
                </li>`;

                $("#list-quiz"+quiz.id).append(answerTemplate);
                answerIndex += 1;
            })
            if(rightAnswer){
                point += 1;
            }
            quizIndex += 1;
        });
        
        console.log(point + "/" + numberOfQuiz);
        debugger
        readablePoint = Math.ceil(point*10000/numberOfQuiz)/100
        $('.small-point').html(`<i class="material-icons text-muted icon--left">assessment</i>`+readablePoint + `/` + 100 + ` Điểm`);
        $('.large-point').html(`Bạn được ` + readablePoint + ` điểm`);
        // if()
        if(readablePoint > section.students[0].pivot.highest_point){
            saveHighestScore(readablePoint);
            section.students[0].pivot.highest_point = readablePoint
        }
    }
})

$(document).on('click', '.prev-quiz', function(e){
    e.preventDefault();
    console.log($(this).text());
    quiz = getPrevQuiz(currentLearn.id);
    if(!quiz){

    }else{
        userAnswers[currentLearn.id] = [];

        answers = document.getElementsByClassName('answer_pane')[0].getElementsByTagName('input');
        for (let index = 0; index < answers.length; index++) {
            const answer = answers[index];
            if(answer.checked) userAnswers[currentLearn.id].push(index);
        }
        console.log(userAnswers[currentLearn.id]);
        fillViewWithQuiz(quiz.section_id, quiz.id);

    }
})

$(document).on('click', '.requiz', function(e){
    e.preventDefault();
    removeAllActiveContent();
    $("#quiz-view").addClass("active");
    userAnswers = [];
    fillViewWithQuiz(currentLearn.section_id, getSection(currentLearn.section_id).quizzes[0].id);
})

$(document).on('click', '.continue-learn', function(e){
    e.preventDefault();
    clearView();
    removeAllActiveContent();
    $("#lesson-view").addClass("active");
    debugger
    section = getNextSection(currentLearn.section_id);
    $('.selectsection[section-id="'+section.id+'"]').addClass('active');
    $('.viewlesson[lesson-id="'+section.lessons[0].id+'"]').addClass('active');
    fillViewWithLesson(section.id, section.lessons[0].id);
})

$(document).on('click', '.next-learn', function(e){
    e.preventDefault();
    next = getNextLesson(currentLearn.id);
    if(!next){
        section = getSection(currentLearn.section_id);
        // a = getQuiz(section.quizzes[0].id);
        next = getFirstQuiz(section);
        if(!next){
            next = getNextSection(section.id);
            if(!next){
            }else{
                next = next.lessons[0];
                next.type = 'lesson';
            }
        }else{
            next.type = 'quiz';
        }
    }else{
        next.type = 'lesson';
    }
    if(!next){
        toastr.info("Bạn đã hoàn thành khoá học");
    }else{
        clearView();
        removeAllActiveContent();
        if(next.type == 'lesson'){
            $('.selectsection[section-id="'+next.section_id+'"]').addClass('active');
            $('.viewlesson[lesson-id="'+next.id+'"]').addClass('active');
            $("#lesson-view").addClass("active");
            fillViewWithLesson(next.section_id, next.id);
        }else{
            section = getSection(next.section_id);
            $('.selectsection[section-id="'+next.section_id+'"]').addClass('active');
            $('.selectsection[section-id="'+next.section_id+'"] .viewquiz').addClass('active');

            if(!section.students[0] || !section.students[0].pivot || !section.students[0].pivot.highest_point){
                userAnswers = [];
                $("#quiz-view").addClass("active");
                fillViewWithQuiz(next.section_id, next.id);
            }else{
                $("#quiz-result").addClass("active");
                $(".result-container").html('');
                $('.small-point').html(`<i class="material-icons text-muted icon--left">assessment</i>`+(section.students[0].pivot.highest_point) + `/` + 100 + ` Điểm`);
                $('.large-point').html(`Điểm cao nhất: ` + section.students[0].pivot.highest_point + ` điểm`);
            }
        }
    }
})
$(document).on('click', '.prev-learn', function(e){
    e.preventDefault();
    debugger
    prev = getPrevLesson(currentLearn.id);
    if(!prev){
        prev = getPrevSection(currentLearn.section_id);
        if(!prev){
        }else{
            prev = prev.lessons[prev.lessons.length - 1];
        }
    }
    if(!prev){
        toastr.info("Đây là bài học đầu tiên");
    }else{
        clearView();
        removeAllActiveContent();
        $('.selectsection[section-id="'+prev.section_id+'"]').addClass('active');
        $('.viewlesson[lesson-id="'+prev.id+'"]').addClass('active');
        $("#lesson-view").addClass("active");
        fillViewWithLesson(prev.section_id, prev.id);
    }
})

function lessonInSectionCheckPoint(){
    var lesson_id = currentLearn.id;
    var section_id = currentLearn.section_id;
    var course_id = course.id;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("input[name='_token']").val()
        }
    });
    
    $.ajax({
        url: "/student/section-lesson",
        type: "POST",
        data: {lesson_id: lesson_id, section_id:section_id, course_id:course_id},
        success: function (data) {
            console.log(data.mss);
        },
        error: function (data){
            console.log(data.mss);
        }
    });
}

function saveHighestScore(score){
    var section_id = currentLearn.section_id;
    var course_id = course.id;
    // var progress = 0;
    // for (let sectionIndex = 1; sectionIndex < course.sections.length; sectionIndex++) {
    //     if(course.sections[sectionIndex].id == section_id) {
    //         progress = round((sectionIndex/course.sections.length)*10000)/100;
    //     }
    // }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("input[name='_token']").val()
        }
    });
    
    $.ajax({
        url: "/student/section-score",
        type: "POST",
        data: {course_id:course_id, section_id: section_id, score:score},
        success: function (data) {
            console.log(data.mss);
        },
        error: function (data){
            console.log(data.mss);
        }
    });
}