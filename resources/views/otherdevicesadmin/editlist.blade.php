@extends('admin.dashboard')

@section('content')
    <style>
        input {
            margin-bottom: 15px;
        }

        body {
            margin: 45px;
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

    <h2>Update Devices</h2>

    <form method="post" action="{{ url('admin/updateotherdevice') }}" class="row g-3">
        @csrf

        <lable for="network_switches">Network Switches</lable>
        <input type="number" class="form-control" name="network_switches" value="{{ $data->network_switches }}">
        <lable for="ups_load">Ups Load</lable>
        <input type="number" class="form-control" name="ups_load" value="{{ $data->ups_load }}">
        <lable for="ac_load">Ac Load</lable>
        <input type="number" class="form-control" name="ac_load" value="{{ $data->ac_load }}">
        <lable for="wifi_access_points">Wifi Access Point:</lable>
        <input type="number" class="form-control" name="wifi_access_points" value="{{ $data->wifi_access_points }}">
        <input type="hidden" name="id" value="{{ $data->id }}">
        <input type="text" hidden value={{ urlencode(Auth::user()->labname) }} id="lab_name" name="lab_name">
        <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href='{{ route('admin.otherdevice', ['lab_name' => Auth::user()->labname]) }}'
                class="btn btn-danger">Back</a>
        </div>
    </form>
@endsection
