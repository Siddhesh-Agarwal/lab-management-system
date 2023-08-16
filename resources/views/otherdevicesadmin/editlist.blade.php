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
    @if (Session::has('notification'))
        <script>
            toastr.success('{{ Session::get('notification') }}');
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
        <input type="text" hidden value={{ Auth::user()->labname }} id="lab_name" name="lab_name">
        <button type="submit" class="btn btn-primary">Update</button>
        <hr>
        <a href='{{ route('admin.otherdevice', ['lab_name'=>Auth::user()->labname]) }}' class="btn btn-danger">Back</a>

    </form>
@endsection
