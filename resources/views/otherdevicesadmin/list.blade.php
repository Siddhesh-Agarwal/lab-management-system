@extends('admin.dashboard')

@section('content')
    <style>
        table tr,
        table th,
        table td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        .button-actions {
            display: flex;
            flex-direction: row;
        }
    </style>

    <section class="content">
        <div class="container">
            <div class="container-fluid" style="margin-top: 100px">
                @if (Session::has('success'))
                    <div id="success-alert" class="alert alert-success" role=alert>
                        {{ Session::get('success') }}
                    </div>
                    <script>
                        // Auto-close the success alert after 5 seconds
                        setTimeout(function() {
                            $('#success-alert').fadeOut('slow');
                        }, 5000);
                        // Auto-close the error alert after 5 seconds
                    </script>
                @endif
                @if (Session::has('error'))
                    <div id="error-alert" class="alert alert-danger" role=alert>
                        {{ Session::get('error') }}
                    </div>
                    <script>
                        setTimeout(function() {
                            $('#error-alert').fadeOut('slow');
                        }, 5000);
                    </script>
                @endif
                <div style="width: max-content">
                    <ol class="breadcrumb" >
                        <li class="breadcrumb-item" style="color:black">{{ $lab_name }}</li>
                    </ol>
                </div>
                <div class="row">
                    @if (count($data) > 0)
                        @foreach ($data as $key => $dev)
                            <div class="col-12 col-sm-6 col-md-6">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-signal"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Network Switch</span>
                                        {{ $dev->network_switches }}
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-12 col-sm-6 col-md-6">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cubes"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">AC Load</span>
                                        <span class="info-box-number">{{ $dev->ac_load }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <!-- fix for small devices only -->
                            <div class="clearfix hidden-md-up"></div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-success elevation-1"><i
                                            class="fas fa-bolt nav-icon"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">UPS Load</span>
                                        <span class="info-box-number">{{ $dev->ups_load }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-12 col-sm-6 col-md-6 ">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-rss"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Wifi Switch</span>
                                        <span class="info-box-number">{{ $dev->wifi_access_points }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            @if (Auth::user()->labname == $dev->lab_name)
                                <a href="{{ url('admin/editotherdevice/' . $dev->id) }}"
                                    class="btn btn-primary">Edit</i></a>
                            @endif
                        @endforeach
                    @else
                        <div class="col-12">
                            <div class="card" style="text-align: center; padding:2%;">
                                <h1>No Devices Found !!</h1>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
