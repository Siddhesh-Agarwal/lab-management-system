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

    {{-- <h2>Update Devices</h2> --}}

    <form method="post" action="{{ url('admin/updatelablistdevice') }}" class="row g-3" style="margin-top: 130px">
        @csrf
        <label for="device_name">Device name</label>
        <input type="text" class="form-control" name="device_name" value="{{ $data->device_name }}">
        <label for="system_number">Serial Number</label>
        <input type="text" class="form-control" name="serial_number" value="{{ $data->serial_number }}">
        <label for="device_name">Count</label>
        <input type="number" min="1" class="form-control" id="count" name="count"
        placeholder="Enter Count" required value="{{ $data->count }}">
        <label for="lab_name">Lab name</label>
        <input type="text" class="form-control" id="labname" name="labname" value="{{ $data->labname }}">
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href='{{ route('superadmin.list.consumables') }}'
            class="btn btn-danger">Back</a>
        </div>
    </form>
@endsection
