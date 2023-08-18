@extends('superadmin.dashboard')

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

    <form method="post" action="{{ url('superadmin/updateotherdevice') }}" class="row g-3">
        @csrf

        <label for="network_switches">Network Switches</label>
        <input type="number" class="form-control" name="network_switches" value="{{ $data->network_switches }}">
        <label for="ups_load">Ups Load</label>
        <input type="number" class="form-control" name="ups_load" value="{{ $data->ups_load }}">
        <label for="ac_load">Ac Load</label>
        <input type="number" class="form-control" name="ac_load" value="{{ $data->ac_load }}">
        <label for="wifi_access_points">Wifi Access Point:</label>
        <input type="number" class="form-control" name="wifi_access_points" value="{{ $data->wifi_access_points }}">
        <input type="hidden" name="id" value="{{ $data->id }}">
        <label for="lab_name">Lab Name:</label>
        <select name="lab_name" id="lab_name" class="form-control">
            <option value="Alan Kay" {{ $data->lab_name === 'Alan Kay' ? 'selected' : '' }}>Alan Kay Lab</option>
            <option value="Nicklaus Writh" {{ $data->lab_name === 'Nicklaus Writh' ? 'selected' : '' }}>Nicklaus Writh Lab
            </option>
            <option value="John Backus" {{ $data->lab_name === 'John Backus' ? 'selected' : '' }}>John Backus Lab</option>
            <option value="Djikstra" {{ $data->lab_name === 'Djikstra' ? 'selected' : '' }}>Djikstra Lab</option>
            <option value="Donald Knuth" {{ $data->lab_name === 'Donald Knuth' ? 'selected' : '' }}>Donald Knuth Lab
            </option>
            <option value="EF Codd" {{ $data->lab_name === 'EF Codd' ? 'selected' : '' }}>EF Codd Lab</option>
            <option value="Jimgray" {{ $data->lab_name === 'Jimgray' ? 'selected' : '' }}>Jimgray Lab</option>
            <option value="DSP VLSI" {{ $data->lab_name === 'DSP VLSI' ? 'selected' : '' }}>DSP VLSI Lab</option>
        </select>
        <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href='{{ url('superadmin/otherdevice') }}' class="btn btn-danger">Back</a>
        </div>
    </form>
@endsection
