@extends('layout.app')
@section('active-earnings', 'active')
@section('content')
<div class="pt-32pt">
    <div
        class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center">

            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">Earnings</h2>

                <ol class="breadcrumb p-0 m-0">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>

                    <li class="breadcrumb-item active">

                        Earnings

                    </li>

                </ol>

            </div>
        </div>


    </div>
</div>
















<div class="container page__container page-section">
    <div class="page-separator">
        <div class="page-separator__text">Overview</div>
    </div>

    <div class="card mb-lg-32pt">
        <div class="card-header d-flex align-items-center">
            <strong class="card-title">Revenue</strong>
            <div class="flatpickr-wrapper flatpickr-calendar-right d-flex ml-auto">
                <div id="recent_orders_date" data-toggle="flatpickr" data-flatpickr-wrap="true"
                    data-flatpickr-static="true" data-flatpickr-mode="range"
                    data-flatpickr-alt-format="d/m/Y" data-flatpickr-date-format="d/m/Y">
                    <a href="javascript:void(0)" class="link-date" data-toggle>13/03/2018 to 20/03/2018</a>
                    <input class="d-none" type="hidden" value="13/03/2018 to 20/03/2018" data-input>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="chart-legend mt-0 mb-24pt justify-content-start" id="ordersChartLegend"></div>
            <div class="chart">
                <canvas id="ordersChart" class="chart-canvas js-update-chart-bar"
                    data-chart-legend="#ordersChartLegend" data-chart-prefix="$" data-chart-suffix="k"
                    data-chart-line-background-color="gradient:primary"></canvas>
            </div>
        </div>
    </div>

    <div class="page-separator">
        <div class="page-separator__text">Transactions</div>
    </div>

    <div class="card mb-0">
        <div data-toggle="lists" data-lists-values='[
"js-lists-values-course", 
"js-lists-values-revenue",
"js-lists-values-fees"
]' data-lists-sort-by="js-lists-values-revenue" data-lists-sort-desc="true" class="table-responsive">
            <table class="table table-nowrap table-flush">
                <thead>
                    <tr class="text-uppercase small">
                        <th>
                            <a href="javascript:void(0)" class="sort"
                                data-sort="js-lists-values-course">Course</a>
                        </th>
                        <th class="text-center" style="width:130px">
                            <a href="javascript:void(0)" class="sort"
                                data-sort="js-lists-values-fees">Fees</a>
                        </th>
                        <th class="text-center" style="width:130px">
                            <a href="javascript:void(0)" class="sort"
                                data-sort="js-lists-values-revenue">Revenue</a>
                        </th>
                    </tr>
                </thead>

                <tbody class="list">

                    <tr>
                        <td>
                            <div class="media flex-nowrap align-items-center">
                                <a href="instructor-edit-course" class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                                    <img src="assets/images/paths/angular_routing_200x168.png" alt="course" class="avatar-img rounded">
                                    <span class="overlay__content"></span>
                                </a>
                                <div class="media-body">
                                    <a class="text-body js-lists-values-course" href="instructor-edit-course"><strong>Angular Routing In-Depth</strong></a>
                                    <div class="text-muted small">34 Sales</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center text-black-70">

                            &dollar;<span class="js-lists-values-fees">120</span> USD

                        </td>
                        <td class="text-center text-black-70">
                            &dollar;<span class="js-lists-values-revenue">8,737</span> USD
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="media flex-nowrap align-items-center">
                                <a href="instructor-edit-course" class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                                    <img src="assets/images/paths/angular_testing_200x168.png" alt="course" class="avatar-img rounded">
                                    <span class="overlay__content"></span>
                                </a>
                                <div class="media-body">
                                    <a class="text-body js-lists-values-course" href="instructor-edit-course"><strong>Angular Unit Testing</strong></a>
                                    <div class="text-muted small">38 Sales</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center text-black-70">

                            <span class="js-lists-values-fees sr-only">0</span>
                            <i class="material-icons text-muted">remove</i>

                        </td>
                        <td class="text-center text-black-70">
                            &dollar;<span class="js-lists-values-revenue">2,521</span> USD
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="media flex-nowrap align-items-center">
                                <a href="instructor-edit-course" class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                                    <img src="assets/images/paths/typescript_200x168.png" alt="course" class="avatar-img rounded">
                                    <span class="overlay__content"></span>
                                </a>
                                <div class="media-body">
                                    <a class="text-body js-lists-values-course" href="instructor-edit-course"><strong>Introduction to TypeScript</strong></a>
                                    <div class="text-muted small">8 Sales</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center text-black-70">

                            <span class="js-lists-values-fees sr-only">0</span>
                            <i class="material-icons text-muted">remove</i>

                        </td>
                        <td class="text-center text-black-70">
                            &dollar;<span class="js-lists-values-revenue">1,413</span> USD
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="media flex-nowrap align-items-center">
                                <a href="instructor-edit-course" class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                                    <img src="assets/images/paths/angular_200x168.png" alt="course" class="avatar-img rounded">
                                    <span class="overlay__content"></span>
                                </a>
                                <div class="media-body">
                                    <a class="text-body js-lists-values-course" href="instructor-edit-course"><strong>Learn Angular Fundamentals</strong></a>
                                    <div class="text-muted small">31 Sales</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center text-black-70">

                            <span class="js-lists-values-fees sr-only">0</span>
                            <i class="material-icons text-muted">remove</i>

                        </td>
                        <td class="text-center text-black-70">
                            &dollar;<span class="js-lists-values-revenue">1,234</span> USD
                        </td>
                    </tr>

                </tbody>
                <tfoot class="text-right">
                    <tr>
                        <td>


                            <ul class="pagination justify-content-start pagination-xsm m-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true" class="material-icons">chevron_left</span>
                                        <span>Prev</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Page 1">
                                        <span>1</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Page 2">
                                        <span>2</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span>Next</span>
                                        <span aria-hidden="true" class="material-icons">chevron_right</span>
                                    </a>
                                </li>
                            </ul>
                        </td>
                        <td colspan="2">Total <i class="material-icons text-muted">remove</i> <strong>&dollar;6,129 USD</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection