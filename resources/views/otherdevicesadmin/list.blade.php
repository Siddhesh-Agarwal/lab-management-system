@extends('admin.dashboard')

@section('content')
    <style>
        table tr,
        table th,
        table td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        table th {
            color: black;
        }

        body {
            margin-top: 75px;
        }

        .button-actions {
            display: flex;
            flex-direction: row;
        }
    </style>

    @if (session('success '))
        <script>
            toastr.success('{{ Session::get('success') }}');
        </script>
    @endif

    @if (session('error'))
        <script>
            toastr.error('{{ Session::get('notification') }}');
        </script>
    @endif
    
    <section class="content">
        @if ($data[0]->lab_name === Auth::user()->labname)
            {{-- <a href="{{ url('admin/addotherdevice') }}" class="btn btn-primary">Add</a><br><br> --}}
        @endif
        <div class="container-fluid">
            <div class="row">
                @foreach ($data as $key => $dev)
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-signal"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Network Switch</span>
                                {{ $dev->network_switches }}
                                <span class="info-box-number">

                                    {{-- <small>%</small> --}}
                                </span>
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
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-bolt nav-icon"></i></span>

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
                        <a href="{{ url('admin/editotherdevice/' . $dev->id) }}" class="btn btn-primary">Edit</i></a>
                    @endif
                @endforeach
            </div>
            {{-- <button class="btn btn-lg bg-purple">Edit</button>
                         --}}
            {{-- <div class="button-actions"> --}}

            {{-- </div> --}}
        </div>
    </section>
@endsection
