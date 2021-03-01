$(document).ready(function() {
    //save list topic
    topicSelectListHTML = $("#select_topic").html();
});
function removeAllActiveContent() {
    $(".content_layout").each(function(index, value) {
        $(this).removeClass("active");
    });
}

function refreshEditPane() {
    deleteSections = [];
    deleteLessons = [];
    deleteQuizzes = [];
    $("#edit_course").attr("course_id", "new");
    $("#course_name").val("");
    $("#course_intro .ql-editor").html("");
    $("#parent").html("");
    $("ul.topic_list").html("");
    $("#select_topic").html(topicSelectListHTML);
    $("#course_price").val(100000);
    // var image = document.getElementById('output_thumbnail');
    // image.src = '';
    // var old_image = document.getElementById('old_thumbnail');
    // old_image.src = '';
    $("#output_thumbnail").attr("src", "");
    $("#old_thumbnail").attr("src", "");
}

function fillEditPane(course) {
    $("#course_name").val(course.name);
    $("#course_intro .ql-editor").html(course.introduce);
    $("ul.topic_list").html("");
    $("#select_topic").html(topicSelectListHTML);
    $("#course_price").val(course.price);
    // var old_image = document.getElementById('old_thumbnail');
    // old_image.src = course.thumbnail_url;
    $("#old_thumbnail").attr("src", course.thumbnail_url);
    debugger
    course.topics.forEach(topic => {
        var option = $("[topic_id="+topic.id+"]");
        if (option.length > 0) {
            var topic = option.text().trim();
            var topic_id = option.attr("topic_id");
            removeByAttr(options, 'value', topic_id);
            option.remove();
            var topic_item =
                `
            <li style="background-color:` +
                getRandomColor() +
                `" class="topic_item" topic_id="` +
                topic_id +
                `">` +
                topic +
                `
                <i class="fa fa-times topic-remove"></i>
            </li>`;
            $(".topic_list").append(topic_item);
        }
    });

    $.ajaxSetup({
        headers: {
            // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            "X-CSRF-TOKEN": $("input[name='_token']").val()
        }
    });

    $.ajax({
        url: "/instructor/edit-course",
        type: "GET",
        data: { course_id: course.id },
        success: function(data) {
            $("#parent").html(data);
            numLessons = 0;
            while (true) {
                if ($("#olquill" + numLessons).length > 0) {
                    var quill = new Quill($("#olquill" + numLessons++).get(0), {
                        theme: "snow"
                    });
                } else break;
            }
            numQuizzes = 0;
            while (true) {
                if ($("#oqquill" + numQuizzes).length > 0) {
                    var quill = new Quill($("#oqquill" + numQuizzes++).get(0), {
                        theme: "snow"
                    });
                } else break;
            }
        },
        error: function(data) {
            toastr.error(data.mss, "Lỗi");
        }
    });
}
$(document).on("click", ".refreshQuill", function() {
    var quill = new Quill($("#lquill0").get(0), {
        theme: "snow"
    });
    quill.focus();
});

function activeContent(content_id) {
    removeAllActiveContent();
    $("#" + content_id).addClass("active");
}

function manageCourse() {
    activeContent("manage_course");
    $(".breadcrumb").empty();
    $(".breadcrumb").append(
        '<li class="breadcrumb-item"><a href="{{route(\'home\')}}">Home</a></li>'
    );
    $(".breadcrumb").append(
        '<li class="breadcrumb-item">Quản lý khoá học</li>'
    );
    $(".add_button").show();
}
function addCourse() {
    activeContent("edit_course");
    $(".breadcrumb").empty();
    $(".breadcrumb").append(
        '<li class="breadcrumb-item"><a href="{{route(\'home\')}}">Home</a></li>'
    );
    $(".breadcrumb").append(
        '<li class="manage_course_btn breadcrumb-item"><a style="cursor:pointer" onclick="manageCourse()">Quản lý khoá học</a></li>'
    );
    $(".breadcrumb").append(
        '<li class="breadcrumb-item active">Thêm khoá học</li>'
    );
    $(".add_button").hide();

    // $("#edit_course").attr("course_id", "new");
    refreshEditPane();
}

$(document).on("click", ".editCourse", function(e) {
    var classList = this.className.split(' ')
    course_id = classList[classList.length - 1];
    editCourse(course_id);
});

function editCourse(course_id) {
    activeContent("edit_course");
    refreshEditPane();
    $(".breadcrumb").empty();
    $(".breadcrumb").append(
        '<li class="breadcrumb-item"><a href="{{route(\'home\')}}">Home</a></li>'
    );
    $(".breadcrumb").append(
        '<li class="manage_course_btn breadcrumb-item"><a style="cursor:pointer" onclick="manageCourse()">Quản lý khoá học</a></li>'
    );
    $(".breadcrumb").append(
        '<li class="breadcrumb-item active">Sửa khoá học</li>'
    );
    $(".add_button").hide();

    $("#edit_course").attr("course_id", course_id);
    array = courses.data;
    array.forEach(element => {
        if (element.id == course_id) {
            fillEditPane(element);
        }
    });
}

$(document).on("dblclick", ".editable", function(e) {
    e.stopPropagation();
    var currentEle = $(this);
    var value = $(this).html();
    updateVal(currentEle, value);
});
var isEditOn = false;
function updateVal(currentEle, value) {
    if (isEditOn) {
    } else {
        isEditOn = true;
        $(currentEle).html(
            '<input class="thVal" type="text" value="' + value + '" />'
        );
        $(".thVal").focus();
        $(".thVal").keyup(function(event) {
            if (event.keyCode == 13) {
                if (
                    $(".thVal")
                        .val()
                        .trim() != ""
                ) {
                    $(currentEle).html(
                        $(".thVal")
                            .val()
                            .trim()
                    );
                    currentEle = null;
                    isEditOn = false;
                }
            }
        });

        $(document).click(function(e) {
            if ($(e.target).attr("class") != "thVal") {
                if (
                    $(".thVal")
                        .val()
                        .trim() != ""
                ) {
                    $(currentEle).html(
                        $(".thVal")
                            .val()
                            .trim()
                    );
                    // $(document).off("click");
                } else {
                    $(currentEle).html("Không được bỏ trống đâu!!!");
                }
                currentEle = null;
                isEditOn = false;
            }

            // $(currentEle).html($(".thVal").val());
            // currentEle = null;
        });
    }
}

function addCourseToList(
    course,
    owner_name,
    totalTime,
    totalLessons,
    totalQuizzes
) {
    if (course.thumbnail_url == null || course.thumbnail_url == "") {
        course.thumbnail_url = "assets/images/paths/angular_430x168.png";
    }
    if (totalQuizzes > 0) {
        quizzesNumberTemp =
            `<div class="d-flex align-items-center">
        <span class="material-icons icon-16pt text-black-50 mr-4pt">assessment</span>
        <p class="flex text-black-50 lh-1 mb-0"><small>` +
            totalQuizzes +
            ` Quiz</small></p>
        </div>`;
    } else quizzesNumberTemp = "";
    var course_template =
        `
    <div course_id="` +
        course.id +
        `" class="col-sm-6 col-md-4 col-xl-3">    
        <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary js-overlay mdk-reveal js-mdk-reveal " {{--data-overlay-onload-show data-popover-onload-show data-force-reveal--}} data-partial-height="44" data-toggle="popover" data-trigger="click">
            <a href="instructor-edit-course" class="js-image" data-position="">
            <img src="` +
        course.thumbnail_url +
        `" alt="course">
                <span class="overlay__content align-items-start justify-content-start">
                    <span class="overlay__action card-body d-flex align-items-center">
                        <i class="material-icons mr-4pt">edit</i>
                        <span class="card-title text-white">Sửa</span>
                    </span>
                </span>
            </a>
            <div class="mdk-reveal__content">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex">
                            <a class="card-title mb-4pt" href="instructor-edit-course">` +
        course.name +
        `</a>
                        </div>
                        <a href="instructor-edit-course" class="ml-4pt material-icons text-black-20 card-course__icon-favorite">edit</a>
                    </div>
                    <div class="d-flex">
                        <div class="rating flex">
                            <span class="rating__item"><span class="material-icons">star</span></span>
                            <span class="rating__item"><span class="material-icons">star</span></span>
                            <span class="rating__item"><span class="material-icons">star</span></span>
                            <span class="rating__item"><span class="material-icons">star</span></span>
                            <span class="rating__item"><span class="material-icons">star_border</span></span>
                        </div>
                        <small class="text-black-50">6 hours</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="popoverContainer d-none">
            <div class="media">
                <div class="media-left mr-12pt">
                    <img src="assets/images/paths/angular_40x40@2x.png" width="40" height="40" alt="Angular" class="rounded">
                </div>
                <div class="media-body">
                    <div class="card-title mb-0">` +
        course.name +
        `</div>
                    <p class="lh-1">
                        <span class="text-black-50 small font-weight-bold">
                            ` +
        owner_name +
        `</span>
                    </p>
                </div>
            </div>

            <div class="my-16pt">
                ` +
        course.introduce +
        `
            </div>

            <div ds class="row align-items-center">
                <div class="col-auto">
                    <div class="d-flex align-items-center mb-4pt">
                        <span class="material-icons icon-16pt text-black-50 mr-4pt">access_time</span>
                        <p class="flex text-black-50 lh-1 mb-0"><small>
                            ` +
        Math.floor((totalTime / 60) * 10) / 10 +
        ` giờ</small></p>
                    </div>
                    <div class="d-flex align-items-center mb-4pt">
                        <span class="material-icons icon-16pt text-black-50 mr-4pt">play_circle_outline</span>
                    <p class="flex text-black-50 lh-1 mb-0"><small>` +
        totalLessons +
        ` khoá học</small></p>
                    </div>
                        ` +
        quizzesNumberTemp +
        `
                </div>
                <div class="col text-right">
                    <a class="btn btn-primary whiteButton editCourse ` +
        course.id +
        `">Sửa khoá học</a>
                </div>
            </div>

        </div>

    </div>`;

    $("#manage_course .row").prepend(course_template);
    $("#not_have_course").remove();
}

$(function() {
    $(".accordion__menu").sortable({
        connectWith: ".accordion__menu",
        handle: ".accordion__menu-link"
    });
});

//Edit-Course
$(document).on("click", ".accordion__toggle", function() {
    $(this)
        .next()
        .collapse("toggle");
});

section_count = 0;
function addNewSection(name = "Tên chương") {
    section_id = section_count++;
    var section_template =
        `<div class="section accordion__item" section-id="new">
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
            <a class="accordion__toggle collapsed" data-toggle="collapse" data-target="#course-toc-` +
        section_count++ +
        `" data-parent="#parent">
            <span class="flex editable section_name">` +
        name +
        `</span>
            <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
            </a>
            <div class="accordion__menu collapse" id="course-toc-` +
        section_id++ +
        `">
        </div>
    </div>`;

    $("#parent").append(section_template);

    $(".accordion__menu").sortable({
        connectWith: ".accordion__menu",
        handle: ".accordion__menu-link"
    });
}

$(document).on('click', '.delete_section', function(){
    var thisSection  = $(this).parent().parent();
    if(thisSection.attr('section-id') != 'new'){
        deleteSections.push(thisSection.attr('section-id'));
    }
    thisSection.find('.lesson').each(function(){
        if($(this).attr('lesson-id') != 'new'){
            deleteLessons.push($(this).attr('lesson-id'));
        }
    })
    thisSection.find('.quiz').each(function(){
        if($(this).attr('quiz-id') != 'new'){
            deleteQuizzes.push($(this).attr('quiz-id'));
        }
    })
    $(this).parent().parent().remove();
    // element.parentNode.parentNode.remove();
})

count_quiz = 0;
quiz_quill_count = 0;
function addQuiz(element, name = "Quiz", parent = null) {
    var quiz_template =
        `<div class="quiz" quiz-id="new">
            <div class="accordion__menu-link" id="quiz-` +
        count_quiz +
        `">
                <i class="material-icons text-70 icon-16pt icon--left">drag_handle</i>
                <a class="flex editable quiz_name">` +
        name +
        `</a>
                <button type="button" class="btn ml-2 btn-blue editQuiz" >Quiz</button>
            </div>
            <div id="quiz` +
        count_quiz++ +
        `" class="p-3 collapse">
                <div class="a_quiz">
                    <div class="form-group mb-32pt">
                        <label class="form-label">Câu hỏi</label>
                        <!-- <textarea class="form-control quiz_question" rows="3" placeholder="Câu hỏi..."></textarea> -->
                        <div id="qquill` +
        quiz_quill_count +
        `" style="height: 100px;" class="mb-0 quiz_question" data-toggle="quill" data-quill-placeholder="Câu hỏi...">
                        </div>
                        <small class="form-text text-muted">Đọc <a href="https://viblo.asia/helps/cach-su-dung-markdown-bxjvZYnwkJZ" target="_blank">hướng dẫn </a>để sử dụng markdown</small>
                    </div>
                    <div class="quiz_answer form-row col-md-12 col-sm-12 ml-2" answer-id="new">
                        <div class="ml-3 tooltip_owner">
                            <input type="checkbox" class="form-check-input isAnswer" value="answer">
                            <span class="tooltiptext">Câu trả lời đúng</span>    
                        </div>
                        <div class="ml-1 col-md-8 col-sm-8">
                            <input type="text" class="form-control ans_content" required placeholder="Câu trả lời ...">
                        </div>
                        <button type="button" class="btn btn-success" id="add_answer"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
        `;
    if (element != null) {
        $(element.parentNode.nextElementSibling.nextElementSibling).append(
            quiz_template
        );
    } else {
        $(".section")
            .last()
            .find(".accordion__menu")
            .append(quiz_template);
    }

    var quill = new Quill($("#qquill" + quiz_quill_count++).get(0), {
        theme: "snow"
    });
    quill.focus();
}
$(document).on("click", ".editQuiz", function() {
    $(this)
        .parent()
        .next()
        .collapse("toggle");
});
$(document).on("click", "#add_answer", addAnswer);

function addAnswer(answer = "", isAnswer = false) {
    if (isAnswer) checked = "checked";
    else checked = "";
    var templateSkill =
        `
        <div class="quiz_answer form-row col-md-12 col-sm-12 mt-2 ml-2" answer-id="new">
            <div class="ml-3 tooltip_owner">
                <input type="checkbox" class="form-check-input isAnswer" value="answer" ` +
        checked +
        `>
                <span class="tooltiptext">Câu trả lời đúng</span>    
            </div>
            <div class="ml-1 col-md-8 col-sm-8">
                <input type="text" class="form-control ans_content" required placeholder="Câu trả lời ...">
            </div>
            <button type="button" class="btn btn-success" id="add_answer"><i class="fa fa-plus" aria-hidden="true"></i></button>
            <button type="button" class="btn btn-danger rm_skill ml-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>`;
    // var temp = $(templateSkill).insertBefore('.answer-help');
    $(this)
        .parent()
        .after(templateSkill);
}

$(document).on("click", ".rm_skill", function() {
    $(this)
        .parent()
        .remove();
    $("tempBr").remove();
});

count_lesson = 0;
lesson_quill_count = 0;
function addNewLesson(
    element,
    name = "Tên Bài",
    length = "10m 10s",
    video_url = ""
) {
    var lesson_template =
        `<div class="lesson" lesson-id="new">
            <div class="accordion__menu-link" id="lesson-` +
        count_lesson +
        `">
                <i class="material-icons text-70 icon-16pt icon--left">drag_handle</i>
                <a class="flex editable lesson_name">` +
        name +
        `</a>
                <span class="text-muted editable lesson_length">` +
        length +
        `</span>
                <button type="button" class="btn ml-2 btn-blue editLesson" >Sửa</button>
            </div>
            <div id="lesson` +
        count_lesson++ +
        `" class="p-3 collapse">
                <label class="form-label">Link Video/File Video</label>
                <div class="form-group row">
                    <iframe class="m-3" max-width="100%" src="">
                    </iframe>
                    <input type="text" class="form-control lesson_url" placeholder="URL nhúng video ..." value="` +
                    video_url +
                    `">
                    <input type="file" class="form-control mt-1 video" value="Hoặc tải lên file">
                </div>
                
                <div class="form-group mb-32pt">
                    <label class="form-label">Bài học</label>
                    <!--<textarea class="form-control lesson_info" rows="5" placeholder="Bài học..."></textarea>-->
                    <div id="lquill` +
        lesson_quill_count +
        `" style="height: 150px;" class="mb-0 lesson_info" data-toggle="quill" data-quill-placeholder="Bài học...">
                    </div>
                    <small class="form-text text-muted">Đọc <a href="https://viblo.asia/helps/cach-su-dung-markdown-bxjvZYnwkJZ" target="_blank">hướng dẫn </a>để sử dụng markdown</small>
                </div>
            </div>
        </div>
        `;

    if (element != null) {
        $(element.parentNode.nextElementSibling.nextElementSibling).append(
            lesson_template
        );
    } else {
        $(".section")
            .last()
            .find(".accordion__menu")
            .append(lesson_template);
    }

    var quill = new Quill($("#lquill" + lesson_quill_count++).get(0), {
        theme: "snow"
    });
    quill.focus();
}
$(document).on("click", ".editLesson", function() {
    if ($(this).text() == "Sửa") {
        $(this).text("Xong");
    } else {
        $(this).text("Sửa");
    }
    $(this)
        .parent()
        .next()
        .collapse("toggle");
});

function getRandomColor() {
    var letters = "0123456789ABCDEF";
    var color = "#";
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

//Nav bar toggle
// $(document).on("click", ".dropdown-toggle", function() {
//     console.log($(this).next());
//     $(this)
//         .next()
//         .collapse("toggle");
// });

function loadFile(e) {
    var image = document.getElementById("output_thumbnail");
    image.src = URL.createObjectURL(e.target.files[0]);
    var old_image = document.getElementById("old_thumbnail");
    old_image.src = "";
}

$(document).on("focusout", ".lesson_url", function(e) {
    $(this)
        .prev()
        .attr("src", $(this).val());
});

var options = [];
$(document).on("dblclick", "#select_topic", function() {
    var option = $(this).find("option:selected");
    console.log(option);
    if (option.length > 0) {
        var topic = option.text().trim();
        var topic_id = option.attr("topic_id");
        removeByAttr(options, 'value', topic_id);
        option.remove();
        var topic_item =
            `
        <li style="background-color:` +
            getRandomColor() +
            `" class="topic_item" topic_id="` +
            topic_id +
            `">` +
            topic +
            `
            <i class="fa fa-times topic-remove"></i>
        </li>`;
        $(".topic_list").append(topic_item);
    }
});

$(document).on("click", ".topic-remove", function() {
    var topic = $(this)
        .parent()
        .text()
        .trim();
    var topic_id = $(this)
        .parent()
        .attr("topic_id");
    options.push({
        value: topic_id,
        text: topic
    });
    var option = `<option topic_id="` + topic_id + `">` + topic + `</option>`;
    $("#select_topic").append(option);
    $(this)
        .parent()
        .remove();
});
//jQuery extension method:
jQuery.fn.filterByText = function(textbox) {
    return this.each(function() {
        var select = this;
        $(select)
            .find("option")
            .each(function() {
                options.push({
                    value: $(this).attr("topic_id"),
                    text: $(this).text()
                });
            });
        $(select).data("options", options);
        $(textbox).bind("change keyup", function() {
            var options = $(select)
                .empty()
                .data("options");
            var search = $.trim($(this).val());
            var regex = new RegExp(search, "gi");

            $.each(options, function(i) {
                var option = options[i];
                if (option.text.match(regex) !== null) {
                    $(select).append(
                        $("<option>")
                            .text(option.text)
                            .attr("topic_id", option.value)
                    );
                }
            });
        });
    });
};

$(function() {
    $("#select_topic").filterByText($("#search_topic"));
});

function removeByAttr(arr, attr, value) {
    var i = arr.length;
    while (i--) {
        if (
            arr[i] &&
            arr[i].hasOwnProperty(attr) &&
            arguments.length > 2 && arr[i][attr] === value
        ) {
            arr.splice(i, 1);
        }
    }
    return arr;
}
