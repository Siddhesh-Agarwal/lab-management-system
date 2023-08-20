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
                                <form id="search-form" action="{{ route('superadmin.searchlabs') }}"
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
                                        <a href="{{ route('superadmin.labdetails') }}" class="btn btn-secondary">Back</a>
                                    </div>
                                @endif
                                {{-- <a href="{{ url('superadmin/addotherdevice') }}" class="btn btn-primary">Add</a> --}}
                                <br><br>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>S.no</td> 
                                            <td>Lab Name</td>
                                            <td>Admin</td>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $dev)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                
                                                <td>{{ $dev->lab_name }}</td>
                                                <td>{{ $dev->admin_name }}</td>
                                              
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