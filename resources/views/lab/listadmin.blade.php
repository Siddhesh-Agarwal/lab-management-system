@extends('superadmin.dashboard')

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

    <section class="content" style="margin-top: 100px;">
        <div class="container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="margin: 1%">
                            <div class="card-header">
                                <div style="width: max-content">
                                    <ol class="breadcrumb" >
                                        <li class="breadcrumb-item" style="color:black">Additional Device Details</li>
                                    </ol>
                                </div>
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
                            </div>
                            <!-- /.card-header -->
                            @if (count($data) > 0)
                                <div class="card-body">
                                    @if (!session('search_flag'))
                                        <form id="search-form" action="{{ route('superadmin.searchlabdevices') }}"
                                            method="GET">
                                            <div class="input-group" style="margin-bottom:30px">
                                                <select name="lab_name" id="lab_name" class="form-control">
                                                    @foreach ($labs as $dev)
                                                        <option value="{{ $dev->lab_name }}">{{ $dev->lab_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                    @if (session('search_flag'))
                                        <div id="back-button-section" style="margin-bottom: 20px">
                                            <a href="{{ route('superadmin.lablistdevices') }}"
                                                class="btn btn-secondary">Back</a>
                                        </div>
                                    @endif
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>S.no</th>
                                                <th>Device</th>
                                                <th>Serial</th>
                                                <th>System</th>
                                                <th>Count</th>
                                                <th>Service Description</th>
                                                <th>Lab name</th>
                                                <th>Actions</th>
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
                                                        <div class="button-actions">
                                                            <a href="{{ url('superadmin/editlablistdevices/' . $dev->id) }}"
                                                                class="btn btn-primary"><i
                                                                    class="fas fa-edit fa-1x"></i></a>
                                                            <a href="{{ url('superadmin/deletelablist/' . $dev->id) }}"
                                                                class="btn btn-danger" style="margin-left: 15px;"><i
                                                                    class="fas fa-trash fa-1x"></i></a>
                                                        </div>
                                                    </td>
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
                <!-- /.container-fluid -->
                @php
                    session()->forget('search_flag');
                @endphp
            </div>
        </div>
    </section>
@endsection
