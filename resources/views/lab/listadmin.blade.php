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

    @if (Session::has('notification'))
        <script>
            toastr.success('{{ Session::get('notification') }}');
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

                            <div class="card-body">
                                 @if(!session('search_flag'))
                                <form id="search-form" action="{{ route('superadmin.searchlabdevices') }}"
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
                                        <a href="{{ route('superadmin.lablistdevices') }}" class="btn btn-secondary">Back</a>
                                    </div>
                                @endif 
                                 
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
                                                        <a href="{{ url('superadmin/editlablistdevice/' . $dev->id) }}"
                                                            class="btn btn-primary"><i class="fas fa-edit fa-1x"></i></a>

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
