@extends('admin.dashboard')

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
                                @if ($lab_name === Auth::user()->labname)
                                    <a href="{{ url('admin/addlablistdevice') }}" class="btn btn-primary">Add</a>
                                @endif
                            </div>
                            @if (count($data) > 0)
                                <div class="card-body">
                                    {{-- <h1>Devices for {{ $lab_name }}</h1> --}}

                                    <table class="table">
                                        <thead>
                                            {{-- @foreach ($data as $key => $dev)  --}}
                                            {{-- <tr>
                                            <td colspan="7">
                                                <h1>Devices for {{ $lab_name }}</h1>
                                            </td> --}}
                                            <tr>
                                                <td>S.no</td>
                                                <td>Device</td>
                                                <td>Spec</td>
                                                <td>System Number</td>
                                                <td>System Description</td>
                                                <td>Lab Name</td>
                                                @if ($data[0]->lab_name === Auth::user()->labname)
                                                    <td>Action</td>
                                                @endif
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
                                                    @if (Auth::user()->labname == $dev->lab_name)
                                                        <td>
                                                            <div class="button-actions">
                                                                <a href="{{ url('admin/editlablistdevice/' . $dev->id) }}"
                                                                    class="btn btn-primary"><i
                                                                        class="fas fa-edit fa-1x"></i></a>
                                                                <a class="btn btn-danger"
                                                                    href="{{ url('admin/addlabmovelist/' . $dev->id) }}">
                                                                    <i class="fas fa-exchange-alt fa-1x"></i>
                                                                </a>

                                                            </div>
                                                        </td>
                                                    @endif


                                                <tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                                    <!-- /.card-body -->
                                </div>
                            @else
                                <h1>No devices Found</h1>
                            @endif

                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- Modal -->
                {{-- <div class="modal fade" id="exchangeModal" tabindex="-1" role="dialog"
                    aria-labelledby="exchangeModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exchangeModalLabel">Enter Lab Name for Exchange</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="text" id="labNameInput" class="form-control" placeholder="Enter Lab Name">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="exchangeBtn{{ $key }}"
                                    onclick="showExchangeModal({{ $key }})">Exchange</button>
                            </div>
                        </div>
                    </div>
                </div> --}}
            @endsection
