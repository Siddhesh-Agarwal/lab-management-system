@extends('superadmin.dashboard')

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


    <div class="container" style="margin-top: 100px">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                {{-- <h3 class="card-title">DataTable with minimal features & hover style</h3> --}}
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if (!session('search_flag'))
                                    <form id="search-form" action="{{ route('superadmin.searchotherdevices') }}"
                                        method="GET">
                                        <div class="input-group">
                                            <input type="text" name="lab_name" class="form-control"
                                                placeholder="Search by Lab Name">
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
                                {{-- <a href="{{ url('superadmin/addotherdevice') }}" class="btn btn-primary">Add</a> --}}
                                <br><br>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>S.no</td>
                                            <td>Network Switches</td>
                                            <td>Ups Load</td>
                                            <td>AC Load</td>
                                            <td>Wifi Access Point</td>
                                            <td>Lab Name</td>
                                            <td>Actions</td>


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
                @php
                    session()->forget('search_flag');
                @endphp
            @endsection
