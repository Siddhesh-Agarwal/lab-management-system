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
    <section class="content" style="margin: 20px">
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

        <div class="container" style='magin-top:20px'>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-body">
                                        @if ($lab_name === Auth::user()->labname)
                                            <a href="{{ url('admin/addlistdevice') }}" class="btn btn-primary">Add</a>
                                        @endif
                                    </div>
                                </div>
                                @if (count($data) > 0)
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Device</th>
                                                    <th>Serial</th>
                                                    <th>System</th>
                                                    <th>Count</th>
                                                    <th>Service Description</th>

                                                    <th>Lab name</th>
                                                    @if ($data[0]->lab_name === Auth::user()->labname)
                                                        <th>Action</th>
                                                        <th>Scrap</th>
                                                    @endif
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
                                                        @if (Auth::user()->labname == $dev->lab_name)
                                                            <td><a href="{{ url('admin/editlistdevice/' . $dev->id) }}"
                                                                    class="btn btn-primary">Edit</a>
                                                            </td>
                                                            <td>
                                                                <form method="POST"
                                                                    action="{{ route('temps.moveData', $dev->id) }}"onsubmit="return confirm('Are you sure you want to move this data to scraps?');">
                                                                    @csrf <button type="submit"
                                                                        class="btn btn-secondary">Move
                                                                        to
                                                                        Temp</button>
                                                                </form>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <!-- /.card-body -->
                                    </div>
                                @else
                                    <h1>No devices Found</h1>
                                @endif
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <section class="content" style="margin: 20px">
                    @endsection
