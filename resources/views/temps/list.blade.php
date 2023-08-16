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

        @if ($data->count() == 0)
            <h1>
                <td colspan="3" class="text-center">No Devices Found</td>
            </h1>
        @else
            <p>Total items: {{ $data->sum('count') }}</p>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">

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
                                                <th style="color: white">Return</th>
                                                <th style="color:white">Scrap</th>

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
                                                        <form method="POST"
                                                            action="{{ route('labs.moveBack', $dev->id) }}"onsubmit="return confirm('Are you sure you want to move this data to return?');">
                                                            @csrf <button type="submit" class="btn btn-secondary"><i
                                                                    class="fas  fa-undo fa-1x"></i></button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form method="POST"
                                                            action="{{ route('labs.moveData', $dev->id) }}"onsubmit="return confirm('Are you sure you want to move this data to scraps?');">
                                                            @csrf <button type="submit" class="btn btn-secondary"><i
                                                                    class="fas  fa-save fa-1x"></i></button>
                                                        </form>
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


    {{-- 
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
        </style>
        @if (Session::has('notification'))
            <script>
                toastr.success('{{ Session::get('notification') }}');
            </script>
        @endif
        <div class="container" style='magin-top:20px'>
            @if ($data->count() == 0)
                <h1>
                    <td colspan="3" class="text-center"> No Devices Found</td>
                </h1>
            @else
                <div class="row">
                    <div class="column">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Device</th>
                                    <th>Serial No</th>
                                    <th>System</th>
                                    <th>Count</th>
                                    <th>Lab name</th>
                                    <th>Return</th>
                                    <th>Scrap</th>
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
                                            <td>{{ $dev->lab_name }}</td>
                                            <td>
                                                <form method="POST"
                                                    action="{{ route('labs.moveBack', $dev->id) }}"onsubmit="return confirm('Are you sure you want to move this data to return?');">
                                                    @csrf <button type="submit" class="btn btn-secondary">Return to
                                                        Lab</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form method="POST"
                                                    action="{{ route('labs.moveData', $dev->id) }}"onsubmit="return confirm('Are you sure you want to move this data to scraps?');">
                                                    @csrf <button type="submit" class="btn btn-secondary">Move to
                                                        Scrap</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
        </div>
        @endif
    @endsection --}}
