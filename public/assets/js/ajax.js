$(document).ready(function() {
    // debugger
    toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "3000",
    "extendedTimeOut": "900",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    }
    $("#loginBtn").click(function(e) {
        e.preventDefault();
        // debugger

        grecaptcha.ready(function() {
            grecaptcha.execute('6LcFjQQaAAAAAMybBuOQV3e86OOJKFIeJhSYqVhc', {action: 'login'}).then(function(token) {
                // Add your logic to submit to your backend server here.
                console.log(token);
                $('#usernameHelp').text('');
                $('#passwordHelp').text('');
                var login = $("#login").val();
                var password = $("#password").val();
                var remember_me = $("#remember_me").is(":checked");
                if(login == "" || password == ""){
                    toastr["error"]("Điền đầy đủ thông tin đăng nhập", "Lỗi");
                    stop_wait_server()
                }else{
                    $.ajaxSetup({
                        headers: {
                            // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            'X-CSRF-TOKEN': $("input[name='_token']").val()
                        }
                    });
                    
                    $.ajax({
                        url: "/account/login",
                        type: "POST",
                        data: {login: login, password: password, remember_me: remember_me, captcha:token },
                        success: function (data) {
                            handleLogin(data);
                        },
                        error: function (data){
                            toastr.error(data, "Lỗi");
                            stop_wait_server();
                        }
                    });
                }
            });
        });
    });
    $("#request_change_password").click(function(e) {
        e.preventDefault();
        // $.ajaxSetup({
        //     headers: {
        //         // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         'X-CSRF-TOKEN': $("input[name='_token']").val()
        //     }
        // });
        
        $.ajax({
            url: "/account/request-change-password",
            type: "GET",
            data: {},
            success: function (data) {
                console.log(data.mss);
                toastr.success(data.mss);
            },
            error: function (data){
                // alert("Lỗi: "+data.mss);
                toastr.error(data.mss, "Lỗi");
            }
        });
    });
    $("#resetPswdBtn").click(function(e) {
        e.preventDefault();
        var email = $("#email").val();
        if(email == ""){
            toastr.warning("Điền email/username của bạn");
            // alert("Điền email/username của bạn");
        }else{
            $.ajaxSetup({
                headers: {
                    // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    'X-CSRF-TOKEN': $("input[name='_token']").val()
                }
            });
            
            $.ajax({
                url: "/account/forgot-password",
                type: "GET",
                data: {email: email},
                success: function (data) {
                    console.log(data.mss);
                    showAlert('.alert', data.mss);
                },
                error: function (data){
                    // alert("Lỗi: "+data.mss);
                    toastr.error(data.mss, "Lỗi");
                }
            });
        }
    });
    
    $('#saveCourse').click(function(e, course_id='new'){
        e.preventDefault();
        wait_server();
        var checkValid = true;
        var course ={};
        var videoId = 0;
        var formData = new FormData();
        course.id = $("#edit_course").attr("course_id");
        course.name = $('#course_name').val().trim();
        course.introduce = $('#course_intro').find('.ql-editor').html();
        course.price = $('#course_price').val();
        if( $("#old_thumbnail").attr("src") == '')
            formData.append('thumbnail', $('#course_thumbnail')[0].files[0]);
        if(course.name == ""){
            toastr.warning("Thêm tên khoá học");
            checkValid = false;
        }
        if($('#course_intro').find('.ql-editor').text().trim() == ""){
            toastr.warning("Thêm giới thiệu khoá học");
            checkValid = false;
        }
        if(course.price == ""){
            toastr.warning("Thêm giá cho khoá học");
            checkValid = false;
        }
        course.topics = [];
        $('.topic_list .topic_item').each(function(e){
            course.topics.push($(this).attr("topic_id"));
        });
        if(course.topics.length == 0){
            toastr.warning("Thêm topic cho khoá học");
            checkValid = false;
        }
        course.sections = [];
        $('#parent .section').each(function(e){
            var section = {};
            section.id = $(this).attr("section-id");
            section.name = $(this).find('.section_name').text();
            section.lessons = [];
            $(this).find('.lesson').each(function(e){
                var lesson = {};
                lesson.id = $(this).attr("lesson-id");
                lesson.name = $(this).find('.lesson_name').text();
                lesson.duration = $(this).find('.lesson_length').text();
                lesson.info = $(this).find('.lesson_info').find('.ql-editor').html();
                lesson.url = $(this).find('.lesson_url').val();
                if($(this).find('.video').val()) {
                    formData.append('video'+videoId, $(this).find('.video')[0].files[0]);
                    lesson.video = 'video'+videoId++;
                }
                section.lessons.push(lesson);
                // lesson = {};
            });
            // debugger
        if(section.lessons.length == 0){
                toastr.warning("Vui lòng thêm bài học cho khoá học " + section.name + "!");
                checkValid = false;
            }
            section.quizzes = [];
            $(this).find('.quiz').each(function(e){
                var quiz = {};
                quiz.id = $(this).attr("quiz-id");
                quiz.name = $(this).find('.quiz_name').text();
                quiz.question = $(this).find('.quiz_question').find('.ql-editor').html();
                if($(this).find('.quiz_question').find('.ql-editor').text().trim() == ""){
                    toastr.warning("Thêm câu hỏi cho quiz " + quiz.name + ", chương " + section.name);
                    checkValid = false;
                }
                quiz.answers = [];
                $(this).find('.quiz_answer').each(function(e){
                    var answer = {};
                    answer.id = $(this).attr("answer-id");
                    answer.isAnswer = $(this).find('input.isAnswer').is(':checked');
                    answer.content = $(this).find('input.ans_content').val().trim();
                    if(answer.content != null && answer.content != "")
                        quiz.answers.push(answer);
                });
                if(quiz.answers == 0){
                    toastr.warning("Thêm câu trả lời cho quiz " + quiz.name + ", chương " + section.name);
                    checkValid = false;
                }
                section.quizzes.push(quiz);
            });
            course.sections.push(section);
            // section = {};
        });
        if(course.sections.length == 0){
            toastr.warning("Khoá học phải có ít nhất 1 chương!");
            checkValid = false;
        }
        if(!checkValid){
            stop_wait_server();
            return;
        }
        // formData.append('course', course);
        appendFormdata(formData, course);
        appendFormdata(formData, deleteSections, 'deleteSections');
        appendFormdata(formData, deleteLessons, 'deleteLessons');
        appendFormdata(formData, deleteQuizzes, 'deleteQuizzes');
        debugger
        $.ajaxSetup({
            headers: {
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                'X-CSRF-TOKEN': $("input[name='_token']").val()
            }
        });
        
        $.ajax({
            url: "/instructor/edit-course",
            type: "POST",
            contentType: false,
            enctype: 'multipart/form-data',
            processData: false,
            data: formData,
            // data: {course: course},
            success: function (data) {
                stop_wait_server();
                if(data.status == 'success'){
                    toastr.success(data.message, "Thành công");
                    refreshEditPane();
                    addCourseToList(data.course, data.owner_name);
                    window.location.replace('/instructor/manage-courses');
                }
                else toastr.error(data.message, "Thất bại");
            },
            error: function (data){
                stop_wait_server();
                toastr.error(data.message, "Lỗi");
            }
        });
    });
    
    $('#save_user_info').click(function(e){
        e.preventDefault();
        wait_server();
        var formData = new FormData();
        var name = $("#user_name").val();
        var email = $("#user_email").val();
        var introduce = $('#introduce').find('.ql-editor').html();
        if(name == "" || email == ""){
            toastr["error"]("Điền đầy đủ thông tin đăng nhập", "Lỗi");
            stop_wait_server()
        }else{
            if( $("#old_thumbnail").attr("src") == '')
                formData.append('avatar', $('#avatar')[0].files[0]);
            formData.append('name', name);
            formData.append('email', email);
            formData.append('introduce', introduce);
            debugger
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $("input[name='_token']").val()
                }
            });
            
            $.ajax({
                url: "/account/edit-account-profile",
                type: "POST",
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                data: formData,
                success: function (data) {
                    toastr.success("Lưu thông tin thành công!");
                    debugger
                    location.reload()
                    stop_wait_server();
                },
                error: function (data){
                    debugger
                    toastr.error("Lỗi xác thực", "Lỗi");
                    stop_wait_server();
                }
            });
        }
    })
    // addCourseToList();
    // refreshEditPane();
    
});

function appendFormdata(FormData, data, name){
    debugger
    name = name || '';
    if (typeof data === 'object'){
        $.each(data, function(index, value){
            if (name == ''){
                appendFormdata(FormData, value, index);
            } else {
                appendFormdata(FormData, value, name + '['+index+']');
            }
        })
    } else {
        FormData.append(name, data);
    }
}

/* Phân trang ajax
    Đoạn này hoạt đông được nhưng lỗi dynamically element không nhận
    jquery của thư viện material-disign-kit.js
*/
// Hot Course paginate
$(document).on('click', '.hotLink', function(e){
    e.preventDefault();
    if($(this).hasClass('selected_page')) return;
    var page = $(this).attr('href').split('hotpage=')[1];
    $('.simpleLoader').removeClass('hidden');

    $.ajaxSetup({
        headers: {
            // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            'X-CSRF-TOKEN': $("input[name='_token']").val()
        }
    });
    
    $.ajax({
        url: "/student/browse-course?hotpage=" + page,
        type: "GET",
        success: function (data) {
            console.log(data);
            $('#stackHotCourse').html(data)
            $('.simpleLoader').addClass('hidden');
        },
        error: function (data){
            toastr.error(data, "Lỗi");
        }
    });

    $('.hotLink').each(function(){
        $(this).removeClass('selected_page');
    })
    $(this).addClass('selected_page');
})

function sendVerify(ele, e){
        // debugger
        e = e || window.event;
        e.preventDefault();
        wait_server();
        var href = $('#verifyBtn').attr('href');
        // $.ajaxSetup({
        //     headers: {
        //         // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         'X-CSRF-TOKEN': $("input[name='_token']").val()
        //     }
        // });
        
        $.ajax({
            url: href,
            type: "GET",
            data: {},
            success: function (data) {
                toastr.success(data.mss, data.status);
                stop_wait_server();
            },
            error: function (data){
                toastr.error(data.mss, "Lỗi");
                stop_wait_server();
            }
        });
}
showAlert();
stop_wait_server();
function handleLogin(msg) {
    console.log(msg);
    if(msg.status == 'success'){
        window.location.replace(msg.mss);
        // window.location = msg[1];
    }else if(msg.status == 'error_info'){
        stop_wait_server();
        $('#usernameHelp').text(msg.mss);
    }else if(msg.status == 'error_verify'){
        stop_wait_server();
        $('#usernameHelp').text(msg.mss);
        $('#usernameHelp').append("<a id='verifyBtn' onclick='sendVerify(this, event)' href='/account/send-verify/"+msg.email+"'>&nbsp Gửi lại email xác thực</a>");
    }
    else if(msg.status == 'error_password'){
        stop_wait_server();
        $('#passwordHelp').text(msg.mss);
    }else{
        toastr.error(msg.mss);
    }
}

$(document).on('click', '.follow', function(e){
    e.preventDefault();
    var instructor_id = $(this).attr('instructor-id');
    cmd = $(this).text().trim();
    if( cmd == 'Theo dõi'){
        var url = '/student/follow'
        $(this).text('Bỏ theo dõi');
        $(this).next().children().text(+$(this).next().children().text() + 1);
    }else{
        var url = '/student/unfollow'
        $(this).text('Theo dõi');
        $(this).next().children().text(+$(this).next().children().text() - 1);
    }

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("input[name='_token']").val()
            }
    });

    $.ajax({
        url: url,
        type: "POST",
        data: {instructor_id:instructor_id},
        success: function (data) {
            toastr.success(data.mss, data.status);
        },
        error: function (data){
            toastr.error(data.mss, "Lỗi");
        }
    });
})


$(document).on('click', '#buy_course', function(e){
    e.preventDefault();
    var course_id = $(this).attr('course-id');
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("input[name='_token']").val()
            }
    });

    $.ajax({
        url: '/student/buy-course',
        type: "POST",
        data: {course_id:course_id},
        success: function (data) {
            toastr.success(data.mss, data.status);
            window.location.reload(false); 
        },
        error: function (data){
            toastr.error(data.mss, "Lỗi");
        }
    });
})

