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

    <div class="container" style="margin-top: 20px">
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="margin-top:100px; ">
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
                                {{-- <h3 class="card-title">DataTable with minimal features & hover style</h3> --}}
                            </div>
                            <!-- /.card-header -->
                            @if (count($data) > 0)
                                <div class="card-body">
                                    @if (!session('search_flag'))
                                        <form id="search-form" action="{{ route('superadmin.searchlablistdevices') }}"
                                            method="GET">
                                            <div class="input-group" style="margin-bottom: 30px">
                                                {{-- <input type="text" name="lab_name" class="form-control"
                                                    placeholder="Search by Lab Name"> --}}
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
                                            <a href="{{ url('superadmin/lablist') }}" class="btn btn-secondary">Back</a>
                                        </div>
                                    @endif
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>S.no</th>
                                                <th>Device</th>
                                                <th>Spec</th>
                                                <th>System Number</th>
                                                <th>System Description</th>
                                                <th>Lab Name</th>
                                                <th>Action</th>
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
                                                    <td>
                                                        <div class="button-actions">
                                                            <a href="{{ url('superadmin/editlablistdevice/' . $dev->id) }}"
                                                                class="btn btn-primary"><i
                                                                    class="fas fa-edit fa-1x"></i></a>
                                                            <a href="{{ url('superadmin/deletelablistdevice/' . $dev->id) }}"
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
                @php
                    session()->forget('search_flag');
                @endphp
            </div>
        </section>
    </div>
@endsection
