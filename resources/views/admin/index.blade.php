@extends('admin.layout.app')

@section('content')
<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">

        @include('admin.layout.topbar')

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href={{ route('admin_home') }}>Vina School</a></li>
                                <li class="breadcrumb-item"><a href={{ route('admin_home') }}>Dashboard</a></li>
                                <li class="breadcrumb-item active">CRM</li>
                            </ol>
                        </div>
                        <h4 class="page-title">CRM</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-xl-3 col-lg-6">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-right">
                                <button type="button" class="btn btn-sm btn-light">View</button>
                            </div>
                            <h6 class="text-muted text-uppercase mt-0" title="Revenue">Active Users</h6>
                            <h3 class="mb-4 mt-2">324</h3>
                            <div id="spark3" class="apex-charts mb-3" data-colors="#f4516c"></div>

                            <div class="row text-center">
                                <div class="col-6">
                                    <h6 class="text-truncate d-block">Last Month</h6>
                                    <p class="font-18 mb-0 text-success">+15%</p>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-truncate d-block">Current Month</h6>
                                    <p class="font-18 mb-0 text-danger">-6.87%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col-->
                <div class="col-xl-3 col-lg-6">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-right">
                                <button type="button" class="btn btn-sm btn-light">View</button>
                            </div>
                            <h6 class="text-muted text-uppercase mt-0" title="Revenue">Expense Summary</h6>
                            <h3 class="mb-4 mt-2">$4,745.2</h3>
                            <div id="spark4" class="apex-charts mb-3" data-colors="#00c5dc"></div>

                            <div class="row text-center">
                                <div class="col-6">
                                    <h6 class="text-truncate d-block">Last Month</h6>
                                    <p class="font-18 mb-0">$7814</p>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-truncate d-block">Current Month</h6>
                                    <p class="font-18 mb-0">$4782.8</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col-->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->

    @include('admin.layout.footer')

</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->
@endsection
