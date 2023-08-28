@extends('superadmin.dashboard')

@section('content')
    <style>
        input {
            margin-bottom: 15px;
        }
    </style>
    <section class="content" style="margin-top: 100px;">
        <div class="container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="height: 70px">
                                <div style="width: max-content">
                                    <ol class="breadcrumb" >
                                        <li class="breadcrumb-item" style="color:black">Edit Lab</li>
                                    </ol>
                                </div>
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
                            </div>
                            <div style="margin: 30px">
                                <form method="post" action="{{ url('superadmin/updatelistinglabs') }}" class="row g-3">
                                    @csrf
                                    <input class="input" type="hidden" name="id" value="{{ $data->id }}">
                                    <label for="lab_name">Lab Name</label>
                                    <input type="text" class="form-control" id="lab_name" name="lab_name"
                                        placeholder="Enter Lab Name" required value="{{ $data->lab_name }}">
                                    <label for="lab_code">Lab Code</label>
                                    <input type="text" class="form-control" id="lab_code" name="lab_code"
                                        placeholder="Enter Lab Code" value="{{ $data->lab_code }}">
                                    <label for="department">Department</label>
                                    <input type="text" class="form-control" id="department" name="department"
                                        placeholder="Enter Department" required value="{{ $data->department }}">
                                    <label for="block">Block</label>
                                    <input type="text" class="form-control" id="block" name="block"
                                        placeholder="Enter the Block" required value="{{ $data->block }}">
                                    <label for="room_number">Room Number</label>
                                    <input type="text" class="form-control" id="room_number" name="room_number"
                                        placeholder="Enter the Room Number" required value="{{ $data->room_number }}">
                                    <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href='{{ route('superadmin.listinglabs') }}' class="btn btn-danger">Back</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
