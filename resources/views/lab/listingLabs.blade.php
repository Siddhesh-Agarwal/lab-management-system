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
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Lab Name</th>
                                        <th>Lab Code</th>
                                        <th>Department</th>
                                        <th>Block</th>
                                        <th>Room Number</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($labs as $key => $dev)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $dev->lab_name }}</td>
                                            <td>{{ $dev->lab_code }}</td>
                                            <td>{{ $dev->department }}</td>
                                            <td>{{ $dev->block }}</td>
                                            <td>{{ $dev->room_number }}</td>
                                            <td>
                                                <div class="button-actions">
                                                    <a href="{{ url('superadmin/editlistinglabs/' . $dev->id) }}"
                                                        class="btn btn-primary"><i class="fas fa-edit fa-1x"></i></a>
                                                    {{-- <a href="{{ url('superadmin/deleteotherdevice/' . $dev->id) }}" class="btn btn-danger"
                                style="margin-left: 15px;"><i class="fas fa-trash fa-1x"></i></a> --}}
                                                </div>
                                            </td>
                                        <tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
