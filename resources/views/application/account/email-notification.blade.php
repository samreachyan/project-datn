@extends('layout.app')


@section('content')
<div class="pt-32pt">
    <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center">

            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">Account</h2>

                <ol class="breadcrumb p-0 m-0">
                    <li class="breadcrumb-item"><a href="index">Home</a></li>

                    <li class="breadcrumb-item">

                        <a href="">Account</a>

                    </li>

                    <li class="breadcrumb-item active">

                        Edit Account

                    </li>

                </ol>

            </div>
        </div>


    </div>
</div>

<div class="page-section container page__container">
    <div class="page-separator">
        <div class="page-separator__text">Updates from VinaCourse</div>
    </div>
    <div class="col-lg-8 p-0">
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" checked id="customCheck1">
                <label class="custom-control-label" for="customCheck1">VinaCourse Newsletter</label>
                <small class="form-text text-muted">Get the latest on company news.</small>
            </div>
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" checked id="customCheck2">
                <label class="custom-control-label" for="customCheck2">New Content Releases</label>
                <small class="form-text text-muted">Send me an email when new courses or bonus content is released.</small>
            </div>
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" checked id="customCheck3">
                <label class="custom-control-label" for="customCheck3">Product &amp; Feature Updates</label>
                <small class="form-text text-muted">Be the first to know when we announce new features and updates.</small>
            </div>
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" checked id="customCheck4">
                <label class="custom-control-label" for="customCheck4">Emails from Teachers</label>
                <small class="form-text text-muted">Get messages, encouragement and helpful information from your teachers.</small>
            </div>
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck5">
                <label class="custom-control-label" for="customCheck5">Content Suggestions</label>
                <small class="form-text text-muted">Get daily content suggestions to keep you on track.</small>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</div>
@endsection

@section('drawer')
<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-dark-dodger-blue sidebar-left" data-perfect-scrollbar>


            <div class="d-flex align-items-center navbar-height">
                <form action="index" class="search-form search-form--black mx-16pt pr-0 pl-16pt">
                    <input type="text" class="form-control pl-0" placeholder="Search">
                    <button class="btn" type="submit"><i class="material-icons">search</i></button>
                </form>
            </div>



            <a href="index" class="sidebar-brand ">
                <!-- <img class="sidebar-brand-icon" src="assets/images/illustration/student/128/white.svg" alt="VinaCourse"> -->

                <span class="avatar avatar-xl sidebar-brand-icon h-auto">

                    <span class="avatar-title rounded bg-primary"><img src="assets/images/illustration/student/128/white.svg" class="img-fluid" alt="logo" /></span>

                </span>

                <span>VinaCourse</span>
            </a>






            <div class="sidebar-heading">Applications</div>
            <ul class="sidebar-menu">

                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button js-sidebar-collapse" data-toggle="collapse" href="#student_menu">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">school</span>
                        Student
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>
                    </a>
                    <ul class="sidebar-submenu collapse sm-indent" id="student_menu">


                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="index">

                                <span class="sidebar-menu-text">Home</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="courses">

                                <span class="sidebar-menu-text">Browse Courses</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="paths">

                                <span class="sidebar-menu-text">Browse Paths</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="student-dashboard">

                                <span class="sidebar-menu-text">Student Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="student-my-courses">

                                <span class="sidebar-menu-text">My Courses</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="student-paths">

                                <span class="sidebar-menu-text">My Paths</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="student-path">

                                <span class="sidebar-menu-text">Path Details</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="student-course">

                                <span class="sidebar-menu-text">Course Preview</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="student-lesson">

                                <span class="sidebar-menu-text">Lesson Preview</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="student-take-course">

                                <span class="sidebar-menu-text">Take Course</span>
                                <span class="sidebar-menu-badge badge badge-accent badge-notifications ml-auto">PRO</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="student-take-lesson">

                                <span class="sidebar-menu-text">Take Lesson</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="student-take-quiz">

                                <span class="sidebar-menu-text">Take Quiz</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="student-quiz-results">

                                <span class="sidebar-menu-text">My Quizzes</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="student-quiz-result-details">

                                <span class="sidebar-menu-text">Quiz Result</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="student-path-assessment">

                                <span class="sidebar-menu-text">Skill Assessment</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="student-path-assessment-result">

                                <span class="sidebar-menu-text">Skill Result</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button js-sidebar-collapse" data-toggle="collapse" href="#instructor_menu">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">format_shapes</span>
                        Instructor
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>
                    </a>
                    <ul class="sidebar-submenu collapse sm-indent" id="instructor_menu">


                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="instructor-dashboard">

                                <span class="sidebar-menu-text">Instructor Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="instructor-courses">

                                <span class="sidebar-menu-text">Manage Courses</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="instructor-quizzes">

                                <span class="sidebar-menu-text">Manage Quizzes</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="instructor-earnings">

                                <span class="sidebar-menu-text">Earnings</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="instructor-statement">

                                <span class="sidebar-menu-text">Statement</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="instructor-edit-course">

                                <span class="sidebar-menu-text">Edit Course</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="instructor-edit-quiz">

                                <span class="sidebar-menu-text">Edit Quiz</span>
                            </a>
                        </li>

                    </ul>
                </li>



                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button js-sidebar-collapse" data-toggle="collapse" href="#enterprise_menu">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">donut_large</span>
                        Enterprise
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>
                    </a>
                    <ul class="sidebar-submenu collapse sm-indent" id="enterprise_menu">
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="erp-dashboard">
                                <span class="sidebar-menu-text">ERP Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="crm-dashboard">
                                <span class="sidebar-menu-text">CRM Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="hr-dashboard">
                                <span class="sidebar-menu-text">HR Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="employees">
                                <span class="sidebar-menu-text">Employees</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="staff">
                                <span class="sidebar-menu-text">Staff</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="leaves">
                                <span class="sidebar-menu-text">Leaves</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button disabled" href="departments">
                                <span class="sidebar-menu-text">Departments</span>
                            </a>
                        </li>
                        <!-- <li class="sidebar-menu-item">
<a class="sidebar-menu-button disabled" href="documents">
<span class="sidebar-menu-text">Documents</span>
</a>
</li>
<li class="sidebar-menu-item">
<a class="sidebar-menu-button disabled" href="attendance">
<span class="sidebar-menu-text">Attendance</span>
</a>
</li>
<li class="sidebar-menu-item">
<a class="sidebar-menu-button disabled" href="recruitment">
<span class="sidebar-menu-text">Recruitment</span>
</a>
</li>
<li class="sidebar-menu-item">
<a class="sidebar-menu-button disabled" href="payroll">
<span class="sidebar-menu-text">Payroll</span>
</a>
</li>
<li class="sidebar-menu-item">
<a class="sidebar-menu-button disabled" href="training">
<span class="sidebar-menu-text">Training</span>
</a>
</li>
<li class="sidebar-menu-item">
<a class="sidebar-menu-button disabled" href="employee-profile">
<span class="sidebar-menu-text">Employee Profile</span>
</a>
</li>
<li class="sidebar-menu-item">
<a class="sidebar-menu-button disabled" href="accounting">
<span class="sidebar-menu-text">Accounting</span>
</a>
</li>
<li class="sidebar-menu-item">
<a class="sidebar-menu-button disabled" href="inventory">
<span class="sidebar-menu-text">Inventory</span>
</a>
</li> -->
                    </ul>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" data-toggle="collapse" href="#productivity_menu">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">access_time</span>
                        Productivity
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>
                    </a>
                    <ul class="sidebar-submenu collapse sm-indent" id="productivity_menu">
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="projects">
                                <span class="sidebar-menu-text">Projects</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="tasks-board">
                                <span class="sidebar-menu-text">Tasks Board</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="tasks-list">
                                <span class="sidebar-menu-text">Tasks List</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button disabled" href="kanban">
                                <span class="sidebar-menu-text">Kanban</span>
                            </a>
                        </li>
                        <!-- <li class="sidebar-menu-item">
<a class="sidebar-menu-button disabled" href="task-details">
<span class="sidebar-menu-text">Task Details</span>
</a>
</li>
<li class="sidebar-menu-item">
<a class="sidebar-menu-button disabled" href="team-members">
<span class="sidebar-menu-text">Team Members</span>
</a>
</li> -->
                    </ul>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" data-toggle="collapse" href="#ecommerce_menu">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">shopping_cart</span>
                        eCommerce
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>
                    </a>
                    <ul class="sidebar-submenu collapse sm-indent" id="ecommerce_menu">
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ecommerce">
                                <span class="sidebar-menu-text">Shop Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button disabled" href="edit-product">
                                <span class="sidebar-menu-text">Edit Product</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" data-toggle="collapse" href="#messaging_menu">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">message</span>
                        Messaging
                        <span class="sidebar-menu-badge badge badge-accent badge-notifications ml-auto">2</span>
                        <span class="sidebar-menu-toggle-icon"></span>
                    </a>
                    <ul class="sidebar-submenu collapse sm-indent" id="messaging_menu">
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="messages">
                                <span class="sidebar-menu-text">Messages</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="email">
                                <span class="sidebar-menu-text">Email</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" data-toggle="collapse" href="#cms_menu">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">content_copy</span>
                        CMS
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>
                    </a>
                    <ul class="sidebar-submenu collapse sm-indent" id="cms_menu">
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="cms-dashboard">
                                <span class="sidebar-menu-text">CMS Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="posts">
                                <span class="sidebar-menu-text">Posts</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-menu-item active open">
                    <a class="sidebar-menu-button" data-toggle="collapse" href="#account_menu">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">account_box</span>
                        Account
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>
                    </a>
                    <ul class="sidebar-submenu collapse show sm-indent" id="account_menu">
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="pricing">
                                <span class="sidebar-menu-text">Pricing</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="login">
                                <span class="sidebar-menu-text">Login</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="signup">
                                <span class="sidebar-menu-text">Signup</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="signup-payment">
                                <span class="sidebar-menu-text">Payment</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="reset-password">
                                <span class="sidebar-menu-text">Reset Password</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="change-password">
                                <span class="sidebar-menu-text">Change Password</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="edit-account">
                                <span class="sidebar-menu-text">Edit Account</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="edit-account-profile">
                                <span class="sidebar-menu-text">Profile &amp; Privacy</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item active">
                            <a class="sidebar-menu-button" href="edit-account-notifications">
                                <span class="sidebar-menu-text">Email Notifications</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="edit-account-password">
                                <span class="sidebar-menu-text">Account Password</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="billing">
                                <span class="sidebar-menu-text">Subscription</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="billing-upgrade">
                                <span class="sidebar-menu-text">Upgrade Account</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="billing-payment">
                                <span class="sidebar-menu-text">Payment Information</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="billing-history">
                                <span class="sidebar-menu-text">Payment History</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="billing-invoice">
                                <span class="sidebar-menu-text">Invoice</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" data-toggle="collapse" href="#community_menu">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">people_outline</span>
                        Community
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>
                    </a>
                    <ul class="sidebar-submenu collapse sm-indent" id="community_menu">
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="teachers">

                                <span class="sidebar-menu-text">Browse Teachers</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="student-profile">

                                <span class="sidebar-menu-text">Student Profile</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="teacher-profile">

                                <span class="sidebar-menu-text">Teacher Profile</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="blog">

                                <span class="sidebar-menu-text">Blog</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="blog-post">

                                <span class="sidebar-menu-text">Blog Post</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="faq">
                                <span class="sidebar-menu-text">FAQ</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="help-center">
                                <!--  -->
                                <span class="sidebar-menu-text">Help Center</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="discussions">
                                <span class="sidebar-menu-text">Discussions</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="discussion">
                                <span class="sidebar-menu-text">Discussion Details</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="discussions-ask">
                                <span class="sidebar-menu-text">Ask Question</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>


            <div class="sidebar-heading">UI</div>
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" data-toggle="collapse" href="#components_menu">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">tune</span>
                        Components
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>
                    </a>
                    <ul class="sidebar-submenu collapse sm-indent" id="components_menu">
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-buttons">
                                <span class="sidebar-menu-text">Buttons</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-avatars">
                                <span class="sidebar-menu-text">Avatars</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-forms">
                                <span class="sidebar-menu-text">Forms</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-loaders">
                                <span class="sidebar-menu-text">Loaders</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-tables">
                                <span class="sidebar-menu-text">Tables</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-cards">
                                <span class="sidebar-menu-text">Cards</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-icons">
                                <span class="sidebar-menu-text">Icons</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-tabs">
                                <span class="sidebar-menu-text">Tabs</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-alerts">
                                <span class="sidebar-menu-text">Alerts</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-badges">
                                <span class="sidebar-menu-text">Badges</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-progress">
                                <span class="sidebar-menu-text">Progress</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-pagination">
                                <span class="sidebar-menu-text">Pagination</span>
                            </a>
                        </li>
                        <!-- <li class="sidebar-menu-item">
<a class="sidebar-menu-button disabled" href="ui-typography">
<span class="sidebar-menu-text">Typography</span>
</a>
</li>
<li class="sidebar-menu-item">
<a class="sidebar-menu-button disabled" href="ui-colors">
<span class="sidebar-menu-text">Colors</span>
</a>
</li>
<li class="sidebar-menu-item">
<a class="sidebar-menu-button disabled" href="ui-breadcrumb">
<span class="sidebar-menu-text">Breadcrumb</span>
</a>
</li>
<li class="sidebar-menu-item">
<a class="sidebar-menu-button disabled" href="ui-accordions">
<span class="sidebar-menu-text">Accordions</span>
</a>
</li>
<li class="sidebar-menu-item">
<a class="sidebar-menu-button disabled" href="ui-modals">
<span class="sidebar-menu-text">Modals</span>
</a>
</li>
<li class="sidebar-menu-item">
<a class="sidebar-menu-button disabled" href="ui-chips">
<span class="sidebar-menu-text">Chips</span>
</a>
</li> -->
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button disabled" href="">
                                <span class="sidebar-menu-text">Disabled</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" data-toggle="collapse" href="#plugins_menu">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">folder</span>
                        Plugins
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>
                    </a>
                    <ul class="sidebar-submenu collapse sm-indent" id="plugins_menu">
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-plugin-charts">
                                <span class="sidebar-menu-text">Charts</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-plugin-flatpickr">
                                <span class="sidebar-menu-text">Flatpickr</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-plugin-daterangepicker">
                                <span class="sidebar-menu-text">Date Range Picker</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-plugin-dragula">
                                <span class="sidebar-menu-text">Dragula</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-plugin-dropzone">
                                <span class="sidebar-menu-text">Dropzone</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-plugin-range-sliders">
                                <span class="sidebar-menu-text">Range Sliders</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-plugin-quill">
                                <span class="sidebar-menu-text">Quill</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-plugin-select2">
                                <span class="sidebar-menu-text">Select2</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-plugin-nestable">
                                <span class="sidebar-menu-text">Nestable</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-plugin-fancytree">
                                <span class="sidebar-menu-text">Fancy Tree</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-plugin-maps-vector">
                                <span class="sidebar-menu-text">Vector Maps</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-plugin-sweet-alert">
                                <span class="sidebar-menu-text">Sweet Alert</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="ui-plugin-toastr">
                                <span class="sidebar-menu-text">Toastr</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button disabled" href="">
                                <span class="sidebar-menu-text">Disabled</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" data-toggle="collapse" href="#layouts_menu">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">view_compact</span>
                        Layouts
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>
                    </a>
                    <ul class="sidebar-submenu collapse sm-indent" id="layouts_menu">
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="compact-edit-account-notifications">
                                <span class="sidebar-menu-text">Compact</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="mini-edit-account-notifications">
                                <span class="sidebar-menu-text">Mini</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="mini-secondary-edit-account-notifications">
                                <span class="sidebar-menu-text">Mini + Secondary</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item active">
                            <a class="sidebar-menu-button" href="edit-account-notifications">
                                <span class="sidebar-menu-text">App</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="boxed-edit-account-notifications">
                                <span class="sidebar-menu-text">Boxed</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="sticky-edit-account-notifications">
                                <span class="sidebar-menu-text">Sticky</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="fixed-edit-account-notifications">
                                <span class="sidebar-menu-text">Fixed</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>


        </div>
    </div>
</div>
@endsection