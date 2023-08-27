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
        <div class="alert alert-success" role=alert>
            {{ Session::get('success') }}
        </div>
    @endif

    <form method="post" action="{{ route('superadmin.savelabs') }}" class="row g-3" style="margin:130px; ">
        @csrf
        <label for="lab_name">Lab Name:</label>
        <input type="text" class="form-control" id="lab_name" name="lab_name" placeholder="Enter Lab Name" required>
        <label for="lab_code">Lab Code:</label>
        <input type="text" class="form-control" id="code" name="code" placeholder="Enter Lab Code" required>
        <label for="block">Block:</label>
        <input type="text" class="form-control" id="block" name="block" placeholder="Enter Block" required>
        <label for="room_number">Room Number:</label>
        <input type="text" class="form-control" id="room_number" name="room_number" placeholder="Enter Room Number" required>
        <label for="department">Room Number:</label>
        <input type="text" class="form-control" id="department" name="department" placeholder="Enter Department" required>
        <button type="submit" class="btn btn-primary">Add</button>
        <hr>
        <a href='{{ route('superadmin.labdetails') }}' class="btn btn-danger">Back</a>
    </form>
@endsection
