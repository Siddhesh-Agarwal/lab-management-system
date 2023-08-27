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

    <div class="container" style="margin-top: 100px">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
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
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if (!session('search_flag'))
                                    <form id="search-form" action="{{ route('superadmin.searchotherdevices') }}"
                                        method="GET">
                                        <div class="input-group">
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
                                    <div id="back-button-section">
                                        <a href="{{ route('superadmin.otherdevice') }}" class="btn btn-secondary">Back</a>
                                    </div>
                                @endif
                                <br><br>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>S.no</th>
                                            <th>Network Switches</th>
                                            <th>Ups Load</th>
                                            <th>AC Load</th>
                                            <th>Wifi Access Point</th>
                                            <th>Lab Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $dev)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $dev->network_switches }}</td>
                                                <td>{{ $dev->ups_load }}</td>
                                                <td>{{ $dev->ac_load }}</td>
                                                <td>{{ $dev->wifi_access_points }}</td>
                                                <td>{{ $dev->lab_name }}</td>
                                                <td>
                                                    <div class="button-actions">
                                                        <a href="{{ url('superadmin/editotherdevice/' . $dev->id) }}"
                                                            class="btn btn-primary"><i class="fas fa-edit fa-1x"></i></a>

                                                        <a href="{{ url('superadmin/deleteotherdevice/' . $dev->id) }}"
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
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </section>
    </div>
    @php
        session()->forget('search_flag');
    @endphp
@endsection
