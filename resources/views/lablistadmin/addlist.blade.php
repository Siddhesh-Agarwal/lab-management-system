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

    <body>

        @if (Session::has('success'))
            <div class="alert alert-success" role=alert>
                {{ Session::get('success') }}
            </div>
        @endif

        <form method="post" action="{{ url('admin/savelablistdevice') }}" class="row g-3">
            @csrf

            <label for="device_name">Device name</label>
            <input type="text" class="form-control" name="device_name" id="device_name" placeholder="Enter Device Name"
                required>
            <label for="spec">Spec:</label>
            <input type="text" class="form-control" name="spec" id="spec" placeholder="Enter Spec" required>
            <label for="system_number">System Number:</label>
            <input type="text" class="form-control" name="system_number" id="system_number"
                placeholder="Enter System Number" required>
            <label for='desc'>System Description:</label>
            <textarea name="desc" class="form-control" id="desc" cols="30" rows="10"
                placeholder="Enter Description"></textarea>
            <input type="text" hidden value={{ urlencode(Auth::user()->labname) }} id="lab_name" name="lab_name">
            <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
                <button type="submit" class="btn btn-primary">Add</button>
                <a href='{{ route('admin.lablist', ['lab_name' => Auth::user()->labname]) }}'
                    class="btn btn-danger">Back</a>
            </div>
        </form>
    @endsection