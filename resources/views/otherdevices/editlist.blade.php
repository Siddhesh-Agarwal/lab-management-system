@extends('superadmin.dashboard')

@section('content')
    <style>
        input {
            margin-bottom: 15px;
        }

        .alert {
            background-color: rgb(177, 237, 150);
            width: 30%;
        }
    </style>

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


    <section class="content">
        <div class="container">
            <div class="container-fluid">
                <div class="row" style="margin-top:100px;">
                    <div class="col-12">
                        <div class="card" style="margin: 1%">
                            <div class="card-header">
                                <div style="width: max-content">
                                    <ol class="breadcrumb" style="background-color:#FC9E4F">
                                        <li class="breadcrumb-item" style="color:black">Edit Device</li>
                                    </ol>
                                </div>
                                <form method="post" action="{{ url('superadmin/updateotherdevice') }}" class="row g-3">
                                    @csrf
                                    <label for="network_switches">Network Switches</label>
                                    <input type="number" class="form-control" name="network_switches"
                                        value="{{ $data->network_switches }}">
                                    <label for="ups_load">Ups Load</label>
                                    <input type="number" class="form-control" name="ups_load"
                                        value="{{ $data->ups_load }}">
                                    <label for="ac_load">Ac Load</label>
                                    <input type="number" class="form-control" name="ac_load" value="{{ $data->ac_load }}">
                                    <label for="wifi_access_points">Wifi Access Point</label>
                                    <input type="number" class="form-control" name="wifi_access_points"
                                        value="{{ $data->wifi_access_points }}">
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <label for="lab_name">Lab Name</label>
                                    <select name="lab_name" id="lab_name" class="form-control">
                                        <option value="{{ $data->lab_name }}" selected>{{ $data->lab_name }}</option>
                                        @foreach ($labs as $dev)
                                            <option value="{{ $dev->lab_name }}">{{ $dev->lab_name }}</option>
                                        @endforeach
                                    </select>
                                    <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href='{{ url('superadmin/otherdevice') }}' class="btn btn-danger">Back</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
