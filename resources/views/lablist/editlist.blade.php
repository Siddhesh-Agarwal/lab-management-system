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

    <form method="post" action="{{ url('superadmin/updatelablistdevice') }}" class="row g-3">
        @csrf

        <label for="device_name">Device name</label>
        <input type="text" class="form-control" name="device_name" value="{{ $data->device_name }}">
        <label for="spec">Spec</label>
        <input type="text" class="form-control" name="spec" value="{{ $data->spec }}">
        <label for="system_number">System Number</label>
        <input type="text" class="form-control" name="system_number" value="{{ $data->system_number }}">
        <label for="desc">System Description</label>
        <textarea type="text" class="form-control" name="desc">{{ $data->desc }}</textarea>
        <input type="hidden" name="id" value="{{ $data->id }}">
        <label for="desc" style="margin-top: 10px">Lab name</label>
        <select name="lab_name" id="lab_name" class="form-control">
            <option value="Alan Kay" {{ Auth::user()->labname === 'Alan Kay' ? 'selected' : '' }}>Alan Kay Lab</option>
            <option value="Nicklaus Writh" {{ Auth::user()->labname === 'Nicklaus Writh' ? 'selected' : '' }}>Nicklaus
                Writh
                Lab</option>
            <option value="John Backus" {{ Auth::user()->labname === 'John Backus' ? 'selected' : '' }}>John Backus Lab
            </option>
            <option value="Djikstra" {{ Auth::user()->labname === 'Djikstra' ? 'selected' : '' }}>Djikstra Lab
            </option>
            <option value="Donald Knuth" {{ Auth::user()->labname === 'Donald Knuth' ? 'selected' : '' }}>Donald Knuth
                Lab
            </option>
            <option value="EF Codd" {{ Auth::user()->labname === 'EF Codd' ? 'selected' : '' }}>EF Codd Lab</option>
            <option value="Jimgray" {{ Auth::user()->labname === 'Jimgray' ? 'selected' : '' }}>Jimgray Lab</option>
            <option value="DSP VLSI" {{ Auth::user()->labname === 'DSP VLSI' ? 'selected' : '' }}>DSP VLSI Lab</option>
        </select>
        <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href='{{ url('superadmin/lablist') }}' class="btn btn-danger">Back</a>
        </div>
    </form>
@endsection
