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
    <div class="container" style='magin-top:130px'>
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
                        <div class="card" style="margin: 20px; padding:20px;">
                            {{-- <div style="width:max-content; margin-bottom:5px;">
                                <ol class="breadcrumb" style="margin-top:0.5px;">
                                        <p style="color: black; margin-bottom:0px;">Total Devices : {{ $data->sum('count') }}</p>
                                </ol>
                            </div> --}}
                            @if ($data->count() == 0)
                                <div class="card-header">
                                    <h1 style="text-align: center;">
                                        No Requests Found
                                    </h1>
                                </div>
                            @else
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered table-hover  ">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>AC Name</th>
                                                <th>Capacity</th>
                                                <th>Status</th>
                                                <th>Lab name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $dev)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $dev->ac_model }}</td>
                                                    <td>{{ $dev->ac_capacity }}</td>
                                                    <td>{{ $dev->status }}</td>
                                                    <td>{{ $dev->lab_name }}</td>
                                                    <td>
                                                        <div class="button-actions">
                                                            <a href="{{ url('superadmin/editac/' . $dev->id) }}"
                                                                class="btn btn-primary"><i
                                                                    class="fas fa-edit fa-1x"></i></a>
                                                            <a class="btn btn-danger"
                                                                href="{{ url('superadmin/deleteac/' . $dev->id) }}"
                                                                style="margin-left: 15px;">
                                                                <i class="fas fa-trash-alt fa-1x"></i>
                                                            </a>
                                                        </div>
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
        </section>
    </div>
    @endif
@endsection
