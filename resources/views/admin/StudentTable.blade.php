@extends('admin.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Student Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th>S No</th>
                                        <th>Name</th>
                                        <th>Roll No</th>
                                        <th>Department</th>
                                        <th>labname</th>
                                        <th>System No</th>
                                        <th>LoggedIn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $index => $stud)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $stud->name }}</td>
                                            <td>{{ $stud->rollno }}</td>
                                            <td>{{ $stud->department }}</td>
                                            <td>{{ $stud->systemNumber }}</td>
                                            <td>{{ $stud->year }}</td>
                                            <td>
                                                @if ($stud->isLoggedIn)
                                                    <span class="badge badge-success" style="width: 100%">Yes</span>
                                                @else
                                                    <span class="badge badge-danger" style="width: 100%">No</span>
                                                @endif
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
        <!-- /.container-fluid -->
    </section>
@endsection
