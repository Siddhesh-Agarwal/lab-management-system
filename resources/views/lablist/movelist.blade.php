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

    @if (session('success '))
        <script>
            toastr.success('{{ Session::get('success') }}');
        </script>
    @endif

    @if (session('error'))
        <script>
            toastr.error('{{ Session::get('notification') }}');
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
                                {{-- <a href="{{ url('superadmin/addlablistdevice') }}" class="btn btn-primary">Add</a> --}}
                                <br><br>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>S.no</td>
                                            <td>Device</td>
                                            <td>Spec</td>
                                            <td>System Number</td>
                                            <td>System Description</td>
                                            <td>Source</td>
                                            <td>Destination</td>
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
                                                <td>{{ $dev->source }}</td>
                                                <td>{{ $dev->destination }}</td>
                                                <td>
                                                    <div class="button-actions">
                                                        {{-- <a href="{{ url('superadmin/editlablistdevice/' . $dev->id) }}"
                                                            class="btn btn-primary"><i class="fas fa-edit fa-1x"></i></a> --}}
                                                        <form method="POST"
                                                            action="{{ route('labs.moveDestination', $dev->id) }}"onsubmit="return confirm('Are you sure you want to accept the request?');">
                                                            @csrf <button type="submit" class="btn btn-success"><i
                                                                    class="fas fa-check-circle fa-1x"></i>
                                                            </button>
                                                        </form>
                                                        <div style="margin-left: 10px;">
                                                            <form method="POST"
                                                                action="{{ route('labs.moveSource', $dev->id) }}"onsubmit="return confirm('Are you sure you want to reject the request?');">
                                                                @csrf <button type="submit" class="btn btn-danger"><i
                                                                        class="fas fa-times-circle  fa-1x"></i>
                                                                </button>
                                                            </form>
                                                        </div>
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
            @endsection
