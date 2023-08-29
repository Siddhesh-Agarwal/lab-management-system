@extends('superadmin.dashboard')

@section('content')
    <section class="content" style="margin-top: 100px">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-4" style="width:100px; height:100px;"><i class="fa-solid fa-desktop fa-beat fa-lg" style="color: #252525;--fa-beat-scale: 1.5;"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Systems</span>
                            <span class="info-box-number">
                                {{ $deviceCount }}
                                {{-- <small>%</small> --}}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-4" style="width:100px; height:100px;"><i class="fa-solid fa-laptop fa-beat fa-lg" style="color: #252525;--fa-beat-scale: 1.5;"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Laptops</span>
                            <span class="info-box-number">{{ $laptop }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-4" style="width:100px; height:100px;"><i class="fa-solid fa-print fa-beat fa-lg" style="color: #252525;--fa-beat-scale: 1.5;"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Printers</span>
                            <span class="info-box-number">90</span>
                        </div>

                    </div>

                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-4" style="width:100px; height:100px;"><i class="fa-solid fa-users fa-beat fa-lg" style="color: #252525;--fa-beat-scale: 1.5;"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Network Switches</span>
                            <span class="info-box-number">{{ $admins }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-8">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header">
                                @if ($data->count() == 0)
                                    <h1 style="text-align: center;">
                                        No warranty due found
                                    </h1>
                                @else
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>S.no</th>
                                                <th>Warranty Name</th>
                                                <th>System Number</th>
                                                <th>Time Period</th>
                                                <th>Lab Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $dev)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $dev->warranty_name }}</td>
                                                    <td>{{ $dev->system_number }}</td>
                                                    <td>{{ $dev->time_period }}</td>
                                                    <td>{{ $dev->labname }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- /.col -->
                </div>
                <div class="col-md-4">
                    <!-- Info Boxes Style 2 -->
                    <div class="info-box mb-3 bg-warning">
                        <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Warranty Systems</span>
                            <span class="info-box-number">{{ $warranty }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-success">
                        <span class="info-box-icon"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Admins</span>
                            <span class="info-box-number">{{ $admins }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-danger">
                        <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Labs</span>
                            <span class="info-box-number">{{ $labcount }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-info">
                        <span class="info-box-icon"><i class="far fa-comment"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Servers</span>
                            <span class="info-box-number">163,921</span>
                        </div>
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                
            </div>
            <!-- /.row -->
        </div>
        <!--/. container-fluid -->
    </section>
    <style>
        table tr,
        table th,
        table td {
            border: 1px solid #ccc;
            padding: 10px;
        }
    </style>
@endsection
