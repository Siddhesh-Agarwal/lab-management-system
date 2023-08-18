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
    <section class="content" style="margin: 20px">
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


        <form method="post" action="{{ url('admin/updatelistdevice') }}" class="row g-3">
            @csrf

            <input class="input" type="hidden" name="id" value="{{ $data->id }}">
            <label for="device_name">Device Name:</label>
            <input type="text" class="form-control" id="device_name" name="device_name" placeholder="Enter Device Name"
                required value="{{ $data->device_name }}">
            <label for="serial_number">Serial Number:</label>
            <input type="text" class="form-control" id="serial_number" name="serial_number"
                placeholder="Enter Serial Number" value="{{ $data->serial_number }}">
            <label for="system_model_number">System Model Number:</label>
            <input type="text" class="form-control" id="system_model_number" name="system_model_number"
                placeholder="Enter System Model Number" required value="{{ $data->system_model_number }}">
            <label for="count">Count:</label>
            <input type="number" min="0" class="form-control" id="count" name="count"
                placeholder="Enter Count" required value="{{ $data->count }}">
            <label for="desc">Service Description:</label>
            <textarea type="text" class="form-control" id="desc" name="desc" rows="4" cols="50">{{ $data->desc }}</textarea>
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
            </select>
            <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href='{{ route('admin.listdevice', ['lab_name' => Auth::user()->labname]) }}'
                    class="btn btn-danger">Back</a>
            </div>
        </form>
    </section>
@endsection
