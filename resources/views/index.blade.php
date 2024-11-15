@extends('head')
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <br><br>
                {{-- <nav class="navbar navbar-expand navbar-light bg-white topbar mb-1 static-top shadow">

                </nav> --}}
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="{{route('packages.export')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <div class="row">

            <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>tracking code</th>
                        <th>Store</th>
                        <th>package name</th>
                        <th>status</th>
                        <th>Client</th>
                        <th>Phone</th>
                        <th>wilaya</th>
                        <th>Commune</th>
                        <th>delivery type</th>
                    </tr>
                </thead>
                 <tfoot>
                    <tr>
                        <th>tracking code</th>
                        <th>Store</th>
                        <th>package name</th>
                        <th>status</th>
                        <th>Client</th>
                        <th>Phone</th>
                        <th>wilaya</th>
                        <th>Commune</th>
                        <th>delivery type</th>
                    </tr>
                </tfoot>
                <tbody>

                    @foreach ($packages as $pack)
                        <tr>
                            <td>{{$pack->tracking_code}}</td>
                            <td>{{$pack->store->name}}</td>
                            <td>{{$pack->name}}</td>
                            <td>{{$pack->status->name}}</td>
                            <td>{{$pack->client_first_name.$pack->client_last_name}}</td>
                            <td>{{$pack->client_phone}}</td>
                            <td>{{$pack->commune?->wilaya?->name}}</td>
                            <td>{{$pack->commune?->name}}</td>
                            <td>{{$pack->deliveryType?->name}}</td>
                        </tr>
                    @endforeach

                    </tbody>

            </table>
            {{-- {{$packages->links()}} --}}

        </div>
    </div>

                    </div>

                    {{-- {{$packages->links()}} --}}

@extends('footer')
