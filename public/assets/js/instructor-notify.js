var pusher = new Pusher('7c790707ecb2f7364872', {
    encrypted: true,
    cluster: "ap1"
});
var channel = pusher.subscribe('BuyCourseNotifyEvent');
channel.bind('buy-course-notify', function(data) {
    debugger
    if(data.receivers.includes(accountId)){
        var newBuyCourseNotification = `
        <a href="/instructor/manage-courses" class="list-group-item list-group-item-action unread notification-item"
        notifiable-id=${accountId} course-id=${data.course_id}>
            <span class="d-flex align-items-center mb-1">
                <small class="text-black-50">bây giờ</small>
                <span class="ml-auto unread-indicator bg-accent"></span>
            </span>
            <span class="d-flex">
                <span class="avatar avatar-xs mr-2">
                    <span class="avatar-title rounded-circle bg-light">
                    <img src="${data.avatar}" alt="people" class="avatar-img rounded-circle">
                    </span>
                </span>
                <span class="flex d-flex flex-column">
                    <strong class="text-black-100">${data.notifyName}</strong>
                    <span class="text-black-70">Đã ${data.type} khoá học ${data.course_name} của bạn</span>
                </span>
            </span>
        </a>
        `;
        $('#notify-dot').text(+$('#notify-dot').text() + 1);
        $('#notify-dot').removeClass('hidden');
        $('#notify-list').prepend(newBuyCourseNotification);
    }
});

$(document).on('click', '.notification-item', function(e){
    e.preventDefault();
    debugger
    var notification_id = $(this).attr('notification-id');
    if(typeof notification_id !== typeof undefined && notification_id !== false){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("input[name='_token']").val()
            }
        });

        $.ajax({
            url: '/notification/mark-read',
            type: "POST",
            data: {notification_id:notification_id},
            success: function (data) {

            },
            error: function (data){

            }
        });
    }else{
        var notifiable_id = $(this).attr('notifiable-id');
        var course_id = $(this).attr('course-id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("input[name='_token']").val()
            }
        });

        $.ajax({
            url: '/notification/mark-read',
            type: "POST",
            data: {notifiable_id:notifiable_id, course_id:course_id},
            success: function (data) {

            },
            error: function (data){

            }
        });
    }
    window.location.replace($(this).attr('href'));
})
