$(document).ready(function(){
    $("#searchTopicCourse").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#listTopicCourse li").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
});

$(document).on('click', '.filterCourse', function(e){
  e.preventDefault();
  url = $(this).attr('href');
  price =  $('#price').val();
  if(url.indexOf('?') > -1){
    url += "&priceFilter="+price;
  }else{
    url += "?priceFilter="+price;
  }
  window.location.replace(url);
})

$(document).on('click', '#superSearch', function(e){
  e.preventDefault();
  keyword = $('#searchField').val();
  
  $("#request_change_password").click(function(e) {
    e.preventDefault();
    // $.ajaxSetup({
    //     headers: {
    //         // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         'X-CSRF-TOKEN': $("input[name='_token']").val()
    //     }
    // });
    
    $.ajax({
        url: "/student/search",
        type: "GET",
        data: {keyword: keyword},
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
})

$(document).on('click', '.courseLink', function(e){
  e.preventDefault();
  debugger
  if($(this).hasClass('selected_page')) return;
  var page = $(this).attr('href').split('?keyword=')[1];
  $('.simpleLoader.lcourse').removeClass('hidden');

  $.ajaxSetup({
      headers: {
          // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          'X-CSRF-TOKEN': $("input[name='_token']").val()
      }
  });
  
  $.ajax({
      url: "/student/search?keyword=" + page,
      type: "GET",
      success: function (data) {
          console.log(data);
          $('#courseSearchStack').html(data)
          $('.simpleLoader.lcourse').addClass('hidden');
      },
      error: function (data){
          toastr.error(data, "Lỗi");
          $('.simpleLoader.lcourse').addClass('hidden');
      }
  });

  $('.courseLink').each(function(){
      $(this).removeClass('selected_page');
  })
  $(this).addClass('selected_page');
})
$(document).on('click', '.instructorLink', function(e){
  e.preventDefault();
  if($(this).hasClass('selected_page')) return;
  var page = $(this).attr('href').split('?keyword=')[1];
  $('.simpleLoader.linstructor').removeClass('hidden');

  $.ajaxSetup({
      headers: {
          // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          'X-CSRF-TOKEN': $("input[name='_token']").val()
      }
  });
  
  $.ajax({
      url: "/student/search?keyword=" + page,
      type: "GET",
      success: function (data) {
          console.log(data);
          debugger
          $('#instructorSearchStack').html(data)
          $('.simpleLoader.linstructor').addClass('hidden');
      },
      error: function (data){
          toastr.error(data, "Lỗi");
          debugger
          $('.simpleLoader.linstructor').addClass('hidden');
      }
  });

  $('.instructorLink').each(function(){
      $(this).removeClass('selected_page');
  })
  $(this).addClass('selected_page');
})

$(document).on('click', '.rating-star input', function(){
  rate = $(this).val();
  course_id = $(this).parent().attr('course-id');
  // console.log('Rate: '+rate);
  // console.log('CourseId: '+course_id);
  $.ajaxSetup({
      headers: {
          // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          'X-CSRF-TOKEN': $("input[name='_token']").val()
      }
  });

  $.ajax({
      url: "/student/rate-course",
      type: "POST",
      data: {rate:rate, course_id:course_id},
      success: function (data) {
          console.log(data);
      },
      error: function (data){
          console.log(data);
      }
  });

})