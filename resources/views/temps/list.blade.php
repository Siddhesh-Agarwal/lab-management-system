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
        <p style="margin-top:100px; ">Total Devices: {{ $data->sum('count') }}</p>
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

                            @if ($data->count() == 0)
                                <div class="card-header">
                                    <h1 style="text-align: center;">
                                        No Requests Found
                                    </h1>
                                </div>
                            @else
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Device</th>
                                                <th>Serial No</th>
                                                <th>System</th>
                                                <th>Count</th>
                                                <th>Service Description</th>
                                                <th>Lab name</th>
                                                <th>Return</th>
                                                <th>Scrap</th>
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
                                                    <td>
                                                        <form method="POST"
                                                            action="{{ route('labs.moveBack', $dev->id) }}"onsubmit="return confirm('Are you sure you want to return this device?');">
                                                            @csrf <button type="submit" class="btn btn-success"><i
                                                                    class="fas  fa-undo fa-1x"></i></button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form method="POST"
                                                            action="{{ route('labs.moveData', $dev->id) }}"onsubmit="return confirm('Are you sure you want to move this device to scraps?');">
                                                            @csrf <button type="submit" class="btn btn-danger"><i
                                                                    class="fas  fa-save fa-1x"></i></button>
                                                        </form>
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
