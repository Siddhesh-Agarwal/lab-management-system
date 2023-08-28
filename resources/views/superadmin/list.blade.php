@extends('superadmin.dashboard')
@section('content')
    <style>
        table tr,
        table th,
        table td {
            border: 1px solid #ccc;
            padding: 10px;
        }
    </style>

    <div class="container" style="margin-top: 100px">
        @if ($data->count() != 0)
            <a href="{{ url('superadmin/deleteAll') }}" class="btn btn-danger" style="margin-top: 50px;"
                onclick="return confirm('Are you sure want to delete all the scraps ?');">Delete All</a>
        @endif
        <section class="content">
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div style="width: max-content">
                                    <ol class="breadcrumb" >
                                        <li class="breadcrumb-item">
                                            <a href="#" style="color:black">Total scraps</a>
                                        </li>
                                        <li class="breadcrumb-item" style="color:black">{{ $data->sum('count') }}</li>
                                    </ol>
                                </div>
                                @if ($data->count() == 0)
                                    <h1 style="text-align: center;">
                                        No Scraps Found
                                    </h1>
                                @else
                                    {{-- <h3 class="card-title">DataTable with minimal features & hover style</h3> --}}
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Device</th>
                                            <th>Serial No</th>
                                            <th>System</th>
                                            <th>Count</th>
                                            <th>Service Description</th>
                                            <th>Lab name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $dev)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $dev->device_name }}</td>
                                                <td>{{ $dev->serial_number }}</td>
                                                <td>{{ $dev->system_model_number }}</td>
                                                <td>{{ $dev->count }}</td>
                                                <td>{{ $dev->desc }}</td>
                                                <td>{{ $dev->lab_name }}</td>
                                                <td><a href="{{ url('superadmin/deletelist/' . $dev->id) }}"
                                                        class="btn btn-danger"><i class="fas fa-trash fa-1x"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            @endif
        </section>
    </div>
@endsection
