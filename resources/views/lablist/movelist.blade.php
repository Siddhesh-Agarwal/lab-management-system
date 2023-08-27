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

    <div class="container" style='magin-top:20px'>
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="margin-top:130px; ">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
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
                            </div>
                            <!-- /.card-header -->
                            @if (count($data) > 0)
                                <div class="card-body">
                                    <br><br>
                                    <table class="table table-bordered table-hover">
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
                            @else
                                <h1 style="text-align: center">No Requests Found</h1>
                            @endif
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </section>
    </div>
@endsection
