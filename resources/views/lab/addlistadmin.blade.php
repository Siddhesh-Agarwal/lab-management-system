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
        <script>
            toastr.success('{{ Session::get('notification') }}');
        </script>
    @endif

    <body>

        @if (Session::has('success'))
            <div class="alert alert-success" role=alert>
                {{ Session::get('success') }}
            </div>
        @endif

        <body>


            <form method="post" action="{{ url('superadmin/savelistdevice') }}" class="row g-3">
                @csrf

                <label for="device_name">Device Name:</label>
                <input type="text" class="form-control" id="device_name" name="device_name" placeholder="Enter Device Name"
                    required>
                <label for="serial_number">Serial Number:</label>
                <input type="text" class="form-control" id="serial_number" name="serial_number"
                    placeholder="Enter Serial Number">
                <label for="system_model_number">System Model Number:</label>
                <input type="text" class="form-control" id="system_model_number" name="system_model_number"
                    placeholder="Enter System Model No" required>
                <label for="count">Count:</label>
                <input type="number" min="1" value="1" class="form-control" id="count" name="count"
                    placeholder="Enter Count" required>
                <label for="desc">Service Description:</label><br>
                <textarea type="text" class="form-control" id="desc" name="desc" placeholder="Enter desc" rows="4"
                    cols="50"></textarea><br>
                <label for="lab_name">Lab Name:</label> 
                <input type="text" class="form-control" id="lab_name" name="lab_name" placeholder="Enter Lab Name"
                    required>
                {{-- <input type="text"  value={{ Auth::user()->labname }} id="lab_name" name="lab_name"> --}}
                <button type="submit" class="btn btn-primary">Add</button>
                <hr>
                {{-- <a href='{{ url('admin/listdevice') }}' class="btn btn-danger">Back</a>
                 --}}
                 <a href='{{ route('admin.listdevice', ['lab_name'=>Auth::user()->labname]) }}' class="btn btn-danger">Back</a>

            </form>

        </body>
    @endsection
