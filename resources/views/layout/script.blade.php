    <!-- jQuery -->
    <script src="assets/vendor/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/vendor/popper.min.js"></script>
    <script src="assets/vendor/bootstrap.min.js"></script>

    <!-- Perfect Scrollbar -->
    <script src="assets/vendor/perfect-scrollbar.min.js"></script>

    <!-- DOM Factory -->
    <script src="assets/vendor/dom-factory.js"></script>

    <!-- MDK -->
    <script src="assets/vendor/material-design-kit.js"></script>

    <!-- Fix Footer -->
    <script src="assets/vendor/fix-footer.js"></script>

    <!-- App JS -->
    <script src="assets/js/app.js"></script>


    <!-- Global Settings -->
    <script src="assets/js/settings.js"></script>

    <!-- Flatpickr -->
    <script src="assets/vendor/flatpickr/flatpickr.min.js"></script>
    <script src="assets/js/flatpickr.js"></script>

    <!-- Moment.js -->
    <script src="assets/vendor/moment.min.js"></script>
    <script src="assets/vendor/moment-range.min.js"></script>

    <!-- Chart.js -->
    <script src="assets/vendor/Chart.min.js"></script>
    <script src="assets/js/chartjs.js"></script> 

    <!-- Chart.js Samples -->
    <script src="assets/js/page.student-dashboard.js"></script>

    <!-- List.js -->
    <script src="assets/vendor/list.min.js"></script>
    <script src="assets/js/list.js"></script>

    <!-- Tables -->
    <script src="assets/js/toggle-check-all.js"></script>
    <script src="assets/js/check-selected-row.js"></script>

    <!-- Quill -->
    <script src="assets/vendor/quill.min.js"></script>
    <script src="assets/js/quill.js"></script>

    <script src="assets/js/jquery-ui.min.js"></script> 

    {{-- <script src="assets/js/toastr.js"></script>  --}}
    <script src="assets/vendor/toastr.min.js"></script> 

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <script src="assets/js/myjs.js"></script>
    <script src="assets/js/ajax.js"></script>
    @if (Auth::check())
        @if (Auth::user()->role == App\Enums\UserRole::Student)
            <script src="assets/js/student-notify.js"></script>
            <script src="assets/js/student.js"></script>
        @elseif (Auth::user()->role == App\Enums\UserRole::Instructor)
            <script src="assets/js/instructor-notify.js"></script>  
            <script src="assets/js/instructor.js"></script>  
        @endif
    @endif
    <script src="assets/js/layout.js"></script>
    {{-- <script src="assets/js/learn.js"></script> --}}
    @yield('more-script')
    {{-- <script src="/js/app.js"></script> --}}
