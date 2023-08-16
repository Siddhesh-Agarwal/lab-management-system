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

    <form method="post" action="{{ url('admin/updatelablistdevice') }}" class="row g-3">
        @csrf

        <lable for="device_name">Device Name:</lable>
        <input type="text" class="form-control" name="device_name" value="{{ $data->device_name }}">
        <lable for="spec">Spec:</lable>
        <input type="text" class="form-control" name="spec" value="{{ $data->spec }}">
        <lable for="system_number">System Number:</lable>
        <input type="text" class="form-control" name="system_number" value="{{ $data->system_number }}">
        <lable for="desc">System Description:</lable>
        <textarea type="text" class="form-control" name="desc">{{ $data->desc }}</textarea>
        <input type="hidden" name="id" value="{{ $data->id }}">
        {{-- <label for="lab_name">Lab Name:</label> 
        <input type="text" class="form-control" id="lab_name" name="lab_name" placeholder="Enter Lab Name" value="{{ $data->lab_name }}">  --}}
        <input type="text" hidden value={{ urlencode(Auth::user()->labname) }} id="lab_name" name="lab_name">
        <button type="submit" class="btn btn-primary">Update</button>
        <hr>
        <a href='{{ route('admin.lablist', ['lab_name' => urlencode(Auth::user()->labname)]) }}'
            class="btn btn-danger">Back</a>

    </form>
@endsection
