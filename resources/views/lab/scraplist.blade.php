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

    <form method="POST" action="{{ url('admin/labs/movetotemp') }}" class="row g-3">
        @csrf

        <input class="input" type="hidden" name="id" value="{{ $data->id }}">
        <label for="device_name">Device Name:</label>
        <input type="text" class="form-control" id="device_name" name="device_name" placeholder="Enter Device Name"
            required value="{{ $data->device_name }}" readonly>
        <label for="serial_number">Serial Number:</label>
        <input type="text" class="form-control" id="serial_number" name="serial_number"
            placeholder="Enter Serial Number" value="{{ $data->serial_number }}" readonly>
        <label for="system_model_number">System Model Number:</label>
        <input type="text" class="form-control" id="system_model_number" name="system_model_number"
            placeholder="Enter System Model Number" required value="{{ $data->system_model_number }}" readonly>
        <label for="count">Count:</label>
        <input type="number" min="0" class="form-control" id="count" name="count" placeholder="Enter Count"
            required value="{{ $data->count }}">
        <label for="desc">Service Description:</label>
        <textarea type="text" class="form-control" id="desc" name="desc" rows="4" cols="50">{{ $data->desc }}</textarea>
        {{-- <label for="lab_name">Lab Name:</label> --}}
        <input type="text" class="form-control" id="lab_name" name="lab_name" placeholder="Enter Lab Name" required
            value="{{ $data->lab_name }}" hidden>
        <button type="submit" class="btn btn-primary">Move To Temp</button>
        <hr>
        {{-- <a href='{{ url('admin/listdevice') }}' class="btn btn-danger">Back</a>
         --}}
         <a href='{{ route('admin.listdevice', ['lab_name'=>Auth::user()->labname]) }}' class="btn btn-danger">Back</a>


    </form>
@endsection
