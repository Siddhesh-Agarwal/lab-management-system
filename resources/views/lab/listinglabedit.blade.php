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
        <form method="post" action="{{ url('superadmin/updatelistinglabs') }}" class="row g-3" style="margin-top:110px; ">
            @csrf
            <input class="input" type="hidden" name="id" value="{{ $data->id }}">
            <label for="lab_name">Lab Name</label>
            <input type="text" class="form-control" id="lab_name" name="lab_name" placeholder="Enter Lab Name" required
                value="{{ $data->lab_name }}">
            <label for="lab_code">Lab Code</label>
            <input type="text" class="form-control" id="lab_code" name="lab_code" placeholder="Enter Lab Code"
                value="{{ $data->lab_code }}">
            <label for="department">Department</label>
            <input type="text" class="form-control" id="department" name="department" placeholder="Enter Department"
                required value="{{ $data->department }}">
            <label for="block">Block</label>
            <input type="text" class="form-control" id="block" name="block" placeholder="Enter the Block" required
                value="{{ $data->block }}">
            <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href='{{ route('superadmin.listinglabs') }}' class="btn btn-danger">Back</a>
            </div>
        </form>
    </section>
@endsection
