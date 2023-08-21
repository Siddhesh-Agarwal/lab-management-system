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

        <form method="post" action="{{ route('superadmin.savelabs') }}" class="row g-3" style="margin:130px; ">
            @csrf

                <label for="lab_name">Lab Name:</label>
                
                <input type="text" class="form-control" id="lab_name" name="lab_name" placeholder="Enter Lab Name"
                    required>
            <button type="submit" class="btn btn-primary">Add</button>
            <hr>
            <a href='{{ route('superadmin.labdetails') }}' class="btn btn-danger">Back</a>

        </form>
    @endsection
