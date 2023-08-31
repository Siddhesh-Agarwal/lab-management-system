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
    <div class="container" style="margin-top: 70px">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="margin-top: 20px">
                            <div class="card-header">
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
                                <div class="card-body" style="width: 100%; display:flex; align-items:baseline;">
                                    <div style="width: 50%">
                                        @if ($lab_name === Auth::user()->labname)
                                            <a href="{{ url('admin/addlistdevice') }}" class="btn btn-primary">Add</a>
                                        @endif
                                    </div>
                                    <div style="width:100%; display:flex; flex-direction:row-reverse">
                                        <ol class="breadcrumb" style="margin-top:0.5px;">
                                            <li class="breadcrumb-item">
                                                <a href="#">{{ $lab_name }}</a>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (count($data) > 0)
                                    <!-- /.card-header -->
                                    <table class="table table-bordered table-hover">
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
                                                    <th>Maintenance</th>
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
                                                                action="{{ route('temps.movecount', $dev->id) }}">
                                                                @csrf
                                                                <button type="submit" class="btn btn-secondary">Maintenance</button>
                                                            </form>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- /.card-body -->
                                @else
                                    <h1 style="text-align: center">No devices Found</h1>
                                @endif
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
