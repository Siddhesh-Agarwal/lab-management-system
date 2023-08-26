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
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="margin: 20px; padding:20px;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Serial Number</th>
                                        <th>Device Name</th>
                                        <th>Count</th>
                                        <th>Lab Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($consumables as $key => $dev)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $dev->serial_number }}</td>
                                            <td>{{ $dev->device_name }}</td>
                                            <td>{{ $dev->count }}</td>
                                            <td>{{ $dev->labname }}</td>
                                            <td>
                                                <div class="button-actions">
                                                    <a href="{{ url('superadmin/consumables/edit/' . $dev->id) }}"
                                                        class="btn btn-primary"><i class="fas fa-edit fa-1x"></i></a>
                                                        <a href="{{ url('superadmin/deletecosumables/' . $dev->id) }}"
                                                            class="btn btn-danger" style="margin-left: 15px;"><i
                                                                class="fas fa-trash fa-1x"></i></a>
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
