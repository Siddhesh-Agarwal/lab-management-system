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
    </style>
    @if (Session::has('notification'))
        <script>
            toastr.success('{{ Session::get('notification') }}');
        </script>
    @endif
    {{-- <script src="{{ asset('plugin/toastr/toastr.min.js') }}"></script> --}}
    <div class="container" style='magin-top:20px'>

       
            <p>Total scraps: {{ $data->sum('count') }}</p>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    @if ($data->count() == 0)
                                    <h1  style="text-align: center;">
                                        No Scraps Found
                                    </h1>
                                @else
                                    {{-- <h3 class="card-title">DataTable with minimal features & hover style</h3> --}}
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="color: white">S.No</th>
                                                <th style="color: white">Device</th>
                                                <th style="color: white">Serial No</th>
                                                <th style="color: white">System</th>
                                                <th style="color: white">Count</th>
                                                <th style="color: white">Service Description</th>
                                                <th style="color: white">Lab name</th>
                                                <th style="color: white">Action</th>
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
                                                    <td><a href="{{ url('superadmin/deletelist/' . $dev->id) }}"
                                                            class="btn btn-danger"><i class="fas fa-trash fa-1x"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
        @endif
    @endsection
