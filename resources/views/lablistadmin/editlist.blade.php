@extends('admin.dashboard')

@section('content')
    <style>
        input {
            margin-bottom: 15px;
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
        <label for="spec">Spec</label>
        <input type="text" class="form-control" name="spec" value="{{ $data->spec }}">
        <label for="system_number">System Number</label>
        <input type="text" class="form-control" name="system_number" value="{{ $data->system_number }}">
        <label for="desc">System Description</label>
        <textarea type="text" class="form-control" name="desc">{{ $data->desc }}</textarea>
        <input type="hidden" name="id" value="{{ $data->id }}">
        {{-- <label for="lab_name">Lab Name:</label> 
        <input type="text" class="form-control" id="lab_name" name="lab_name" placeholder="Enter Lab Name" value="{{ $data->lab_name }}">  --}}
        <input type="text" hidden value={{ urlencode(Auth::user()->labname) }} id="lab_name" name="lab_name">
        <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href='{{ route('admin.lablist', ['lab_name' => Auth::user()->labname]) }}'
            class="btn btn-danger">Back</a>
        </div>
    </form>
@endsection
