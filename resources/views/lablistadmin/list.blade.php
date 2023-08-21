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

    <div class="container" style="margin-top: 70px">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="margin-top: 20px">
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
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if ($lab_name === Auth::user()->labname)
                                    <a href="{{ url('admin/addlablistdevice') }}" class="btn btn-primary">Add</a>
                                @endif
                            </div>
                            @if (count($data) > 0)
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td>S.no</td>
                                                <td>Device</td>
                                                <td>Spec</td>
                                                <td>System Number</td>
                                                <td>System Description</td>
                                                <td>Lab Name</td>
                                                @if ($data[0]->lab_name === Auth::user()->labname)
                                                    <td>Action</td>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $dev)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $dev->device_name }}</td>
                                                    <td>{{ $dev->spec }}</td>
                                                    <td>{{ $dev->system_number }}</td>
                                                    <td>{{ $dev->desc }}</td>
                                                    <td>{{ $dev->lab_name }}</td>
                                                    @if (Auth::user()->labname == $dev->lab_name)
                                                        <td>
                                                            <div class="button-actions">
                                                                <a href="{{ url('admin/editlablistdevice/' . $dev->id) }}"
                                                                    class="btn btn-primary"><i
                                                                        class="fas fa-edit fa-1x"></i></a>
                                                                <a class="btn btn-danger"
                                                                    href="{{ url('admin/addlabmovelist/' . $dev->id) }}"
                                                                    style="margin-left: 15px;">
                                                                    <i class="fas fa-exchange-alt fa-1x"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    @endif
                                                <tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- /.card-body -->
                                </div>
                            @else
                                <h1 style="text-align: center;">No devices Found</h1>
                            @endif
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </section>
    </div>
@endsection
