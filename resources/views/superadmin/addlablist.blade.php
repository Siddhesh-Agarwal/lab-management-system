@extends('superadmin.dashboard')

@section('content')
    <style>
        input {
            margin-bottom: 15px;
        }
    </style>

    @if (Session::has('success'))
        <div class="alert alert-success" role=alert>
            {{ Session::get('success') }}
        </div>
    @endif

    <section class="content">
        <div class="container">
            <div class="container-fluid">
                <div class="row" style="margin-top:100px;">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add Lab</h3>
                            </div>
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
                            <form method="post" action="{{ route('superadmin.savelabs') }}" class="row g-3"
                                style="margin:30px; ">
                                @csrf
                                <label for="lab_name">Lab Name:</label>
                                <input type="text" class="form-control" id="lab_name" name="lab_name"
                                    placeholder="Enter Lab Name" required>
                                <label for="lab_code">Lab Code:</label>
                                <input type="text" class="form-control" id="code" name="code"
                                    placeholder="Enter Lab Code" required>
                                <label for="block">Block:</label>
                                <input type="text" class="form-control" id="block" name="block"
                                    placeholder="Enter Block" required>
                                <label for="room_number">Room Number:</label>
                                <input type="text" class="form-control" id="room_number" name="room_number"
                                    placeholder="Enter Room Number" required>
                                <label for="department">Department:</label>
                                <input type="text" class="form-control" id="department" name="department"
                                    placeholder="Enter Department" required>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
