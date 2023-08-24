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

    <form method="post" action="{{ url('admin/savelistdevice') }}" class="row g-3" style="margin-top:100px; ">
        @csrf
        <label for="device_name">Device name</label>
        <input type="text" class="form-control" id="device_name" name="device_name" placeholder="Enter Device Name"
            required>
        <label for="serial_number">Serial Number</label>
        <input type="text" class="form-control" id="serial_number" name="serial_number"
            placeholder="Enter Serial Number">
        {{-- <label for="system_model_number">System Model Number:</label>
                <input type="text" class="form-control" id="system_model_number" name="system_model_number"
                    placeholder="Enter System Model No" required> --}}
        <label for="system_model_number">System Number</label>
        <select class="form-control" name="system_model_number" id="system_model_number" required>
            <option value="" selected disabled>Select System Number</option>
            @foreach ($systemNumbers as $systemNumber)
                <option value="{{ $systemNumber }}">{{ $systemNumber }}</option>
            @endforeach
        </select>
        <label for="count" style="margin-top: 15px;">Count</label>
        <input type="number" min="1" value="1" class="form-control" id="count" name="count"
            placeholder="Enter Count" required>
        <label for="desc">Service Description</label><br>
        <textarea type="text" class="form-control" id="desc" name="desc" placeholder="Enter desc" rows="4"
            cols="50"></textarea><br>
        <input type="text" hidden value={{ urlencode(Auth::user()->labname) }} id="lab_name" name="lab_name">
        <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
            <button type="submit" class="btn btn-primary">Add</button>
            <a href='{{ route('admin.listdevice', ['lab_name' => Auth::user()->labname]) }}' class="btn btn-danger">Back</a>
        </div>
    </form>
@endsection
