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
    @if (Session::has('notification'))
        @if (Session::get('notification') == 'success-device-update')
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Updated Successfully !',
                    showConfirmButton: false,
                    timer: 3500
                })
            </script>
        @else
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: "Something went wrong !",
                    showConfirmButton: false,
                    timer: 3500
                })
            </script>
        @endif
    @endif
    <h2>Update Devices</h2>

    <form method="post" action="{{ url('superadmin/updateotherdevice') }}" class="row g-3">
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
        <label for="lab_name">Lab Name:</label>
        <select name="lab_name" id="lab_name" class="form-control">
            <option value="Alan Kay" {{ $data->lab_name === 'Alan Kay' ? 'selected' : '' }}>Alan Kay Lab</option>
            <option value="Nicklaus Writh" {{ $data->lab_name === 'Nicklaus Writh' ? 'selected' : '' }}>Nicklaus Writh Lab</option>
            <option value="John Backus" {{ $data->lab_name === 'John Backus' ? 'selected' : '' }}>John Backus Lab</option>
            <option value="Djikstra Lab" {{ $data->lab_name === 'Djikstra Lab' ? 'selected' : '' }}>Djikstra Lab</option>
            <option value="Donald Knuth" {{ $data->lab_name === 'Donald Knuth' ? 'selected' : '' }}>Donald Knuth Lab</option>
            <option value="EF Codd" {{ $data->lab_name === 'EF Codd' ? 'selected' : '' }}>EF Codd Lab</option>
            <option value="Jimgray" {{ $data->lab_name === 'Jimgray' ? 'selected' : '' }}>Jimgray Lab</option>
            <option value="DSP VLSI" {{ $data->lab_name === 'DSP VLSI' ? 'selected' : '' }}>DSP VLSI Lab</option>
        </select>
        <button type="submit" class="btn btn-primary">Update</button>
        <hr>
        <a href='{{ url('superadmin/otherdevice') }}' class="btn btn-danger">Back</a>

    </form>
@endsection
