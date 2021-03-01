<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from coderthemes.com/hyper/saas/dashboard-crm.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 Dec 2020 17:12:26 GMT -->
<head>
        <meta charset="utf-8" />
        <title>Vina School | Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="/admin/images/favicon.ico">

        <!-- App css -->
        <link href="/admin/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/admin/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
        <link href="/admin/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />

    </head>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <!-- Begin page -->
        <div class="wrapper">

            @include('admin.layout.left-sidebar')

            @yield('content')


        </div>
        <!-- END wrapper -->

        <!-- bundle -->
        <script src="/admin/js/vendor.min.js"></script>
        <script src="/admin/js/app.min.js"></script>

        <!-- Apex js -->
        <script src="/admin/js/vendor/apexcharts.min.js"></script>

        <!-- Todo js -->
        <script src="/admin/js/ui/component.todo.js"></script>

        <!-- demo app -->
        <script src="/admin/js/pages/demo.dashboard-crm.js"></script>
        <!-- end demo js-->

        <!-- demo:js -->
        <script src="/admin/js/pages/demo.widgets.js"></script>
        <!-- demo end -->

        <!-- Chat js -->
        <script src="/admin/js/ui/component.chat.js"></script>
    </body>

<!-- Mirrored from coderthemes.com/hyper/saas/dashboard-crm.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 Dec 2020 17:12:29 GMT -->
</html>
