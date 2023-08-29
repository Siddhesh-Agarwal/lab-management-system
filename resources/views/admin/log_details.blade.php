@extends('admin.dashboard')

@section('content')
    <section class="content" style="margin-top:100px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div style="width: max-content">
                                <ol class="breadcrumb" >
                                    <li class="breadcrumb-item" style="color:black">Log Details</li>
                                </ol>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (count($details) > 0)
                                <table id="example2" class="table table-bordered table-hover" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>S No</th>
                                            <th>Roll No</th>
                                            <th>System Number</th>
                                            <th>Login Time</th>
                                            <th>Logout Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($details as $index => $log)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $log->rollno }}</td>
                                                <td>{{ $log->system_number }}</td>
                                                <td>{{ $log->login_time }}</td>
                                                <td>{{ $log->logout_time }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h1 style="text-align: center">No Logs Found !</h1>
                            @endif
                        </div>
                        <!-- /.card-body -->   
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
