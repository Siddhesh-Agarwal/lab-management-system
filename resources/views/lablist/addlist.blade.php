@extends('superadmin.dashboard')

@section('content')
    <style>
        input {
            margin-bottom: 15px;
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

    <form method="post" action="{{ url('superadmin/savelablistdevice') }}" class="row g-3" style="margin-top: 110px">
        @csrf
        <label for="device_name">Device name</label>
        <input type="text" class="form-control" name="device_name" id="device_name" placeholder="Enter Device Name"
            required>
        <label for="spec">Spec</label>
        <input type="text" class="form-control" name="spec" id="spec" placeholder="Enter Spec" required>
        <label for="system_number">System Number</label>
        <input type="text" class="form-control" name="system_number" id="system_number" placeholder="Enter System Number"
            required>
        <label for='desc'>System Description</label>
        <textarea name="desc" class="form-control" id="desc" cols="30" rows="5"
            placeholder="Enter Description"></textarea>
        <label for="lab_name" style="margin-top: 15px;">Lab Name</label>
        <select name="lab_name" id="lab_name" class="form-control">
            @foreach ($labs as $dev)
                <option value="{{ $dev->lab_name }}">{{ $dev->lab_name }}</option>
            @endforeach
        </select>
        {{-- <label for="lab_name">Lab Name:</label>
            <select name="lab_name" id="lab_name" class="form-control">
                <option value="Alan Kay">Alan Kay Lab</option>
                <option value="Nicklaus Writh">Nicklaus
                    Writh
                    Lab</option>
                <option value="John Backus">John Backus Lab
                </option>
                <option value="Djikstra">Djikstra Lab
                </option>
                <option value="Donald Knuth">Donald Knuth
                    Lab
                </option>
                <option value="EF Codd">EF Codd Lab</option>
                <option value="Jimgray">Jimgray Lab</option>
                <option value="DSP VLSI">DSP VLSI Lab</option>
            </select> --}}
        <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
            <button type="submit" class="btn btn-primary">Add</button>
            <a href='{{ url('superadmin/lablist') }}' class="btn btn-danger">Back</a>
        </div>
    </form>
@endsection
