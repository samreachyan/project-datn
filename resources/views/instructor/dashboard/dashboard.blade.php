@extends('layout.app')
{{-- @section('menu_button', 'd-lg-none') --}}
@section('content')
<div class="pt-32pt">
    <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">Dashboard</h2>

                <ol class="breadcrumb p-0 m-0">
                    <li class="breadcrumb-item"><a href="index">Home</a></li>

                    <li class="breadcrumb-item active">

                        Dashboard

                    </li>

                </ol>

            </div>
        </div>


        <div class="row" role="tablist">
            <div class="col-auto">
                <a href="instructor-earnings" class="btn btn-outline-secondary">Earnings</a>
            </div>
        </div>

    </div>
</div>


<div class="page-section border-bottom-2">
    <div class="container page__container">

        <div class="row">
            <div class="col-lg-4">
                <div class="card border-1 border-left-3 border-left-accent text-center mb-lg-0">
                    <div class="card-body">
                        <h4 class="h2 mb-0">&dollar;1,569.00</h4>
                        <div>Earnings this month</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card text-center mb-lg-0">
                    <div class="card-body">
                        <h4 class="h2 mb-0">&dollar;3,917.80</h4>
                        <div>Account Balance</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card text-center mb-lg-0">
                    <div class="card-body">
                        <h4 class="h2 mb-0">&dollar;10,211.50</h4>
                        <div>Total Sales</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('active-dashboard', 'active')
