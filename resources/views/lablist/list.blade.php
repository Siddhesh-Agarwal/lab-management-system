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

    <div class="container" style='magin-top:20px'>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                {{-- <h3 class="card-title">DataTable with minimal features & hover style</h3> --}}
                            </div>
                            <!-- /.card-header -->
                            @if (count($data) > 0)
                            <div class="card-body">
                                @if (!session('search_flag'))
                                    <form id="search-form" action="{{ route('superadmin.searchlablistdevices') }}"
                                        method="GET">
                                        <div class="input-group" style="margin-bottom: 30px">
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
                                        <a href="{{ route('superadmin.lablist') }}" class="btn btn-secondary">Back</a>
                                    </div>
                                @endif

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>S.no</td>
                                            <td>Device</td>
                                            <td>Spec</td>
                                            <td>System Number</td>
                                            <td>System Description</td>
                                            <td>Lab Name</td>
                                            <td>Action</td>

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
                                                            class="btn btn-primary"><i class="fas fa-edit fa-1x"></i></a>

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
                                <h1  style="text-align: center;">No devices Found</h1>
                            @endif
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                {{-- <script>
                    // JavaScript to show/hide the back button when search is clicked
                    const searchForm = document.querySelector('#search-form');
                    const backButtonSection = document.querySelector('#back-button-section');
            
                    searchForm.addEventListener('submit', () => {
                        backButtonSection.style.display = 'block';
                    });
                </script> --}}
                @php
                    session()->forget('search_flag');
                @endphp
            @endsection
