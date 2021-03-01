@extends('admin.layout.app')

@section('content')
<div class="content-page">
    <div class="content">
        @include('admin.layout.topbar')

        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href={{ route('admin_home') }}>Vina School</a></li>
                                <li class="breadcrumb-item"><a href={{ route('user') }}>Thông tin tải khoàn</a></li>
                                <li class="breadcrumb-item active">Thông tin tải khoàn</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Thông tin tải khoàn</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-4 col-lg-12">
                    <div class="card cta-box bg-white">
                        <table class="table table-centered mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Created at</th>
                                    <th>Active?</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td class="table-user">
                                        <img src={{ asset($item->avatar_url) }} alt="avatar" class="mr-2 rounded-circle" />
                                        {{ $item->username }}
                                    </td>
                                    <td>@if ($item->role == 1) admin @elseif ($item->role == 2) instructor @else student @endif</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                                    <td>
                                        <!-- Switch-->
                                        <div>
                                            {{-- <input type="checkbox" id="switch{{ $item->id }}" checked data-switch="success"/>
                                            <label for="switch{{ $item->id }}" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label> --}}
                                            <a href="{{ route('user') }}/del/{{ $item->id }}" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- pagination  --}}
                    <nav>
                        <ul class="pagination pagination-rounded justify-content-center mb-0">
                            <li class="page-item @if ($accounts->currentPage() == 1) disabled @endif"">
                                <a class="page-link" href="{{ route('user') }}?page={{max($accounts->currentPage() - 1, 1)}}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>

                            @for ($i = 1; $i <= $accounts->lastPage(); $i++)
                            <li class="page-item @if ($i == $accounts->currentPage()) active @endif"><a class="page-link" href="{{ route('user') }}?page={{$i}}">{{ $i }}</a></li>
                            @endfor

                            <li class="page-item @if ($accounts->currentPage() == $accounts->lastPage()) disabled @endif">
                                <a class="page-link" href="{{ route('user') }}?page={{ min($accounts->currentPage() + 1, $accounts->lastPage()) }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>

                </div>
                <!-- end col-->


            </div>
            <!-- end row-->
        </div>


        @include('admin.layout.footer')
    </div>

</div>

@endsection
