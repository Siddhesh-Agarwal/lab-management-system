@extends('superadmin.dashboard')

@section('content')
    <style>
        input {
            margin-bottom: 15px;
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

    @if (Session::has('success'))
        <div class="alert alert-success" role=alert>
            {{ Session::get('success') }}
        </div>
        <script>
            setTimeout(function() {
                $('#error-success').fadeOut('slow');
            }, 5000);
        </script>
    @endif

    <section class="content">
        <div class="container">
            <div class="container-fluid">
                <div class="row" style="margin-top:100px;">
                    <div class="col-12">
                        <div class="card" style="margin: 1%">
                            <div class="card-header">
                                <div style="width: max-content">
                                    <ol class="breadcrumb" >
                                        <li class="breadcrumb-item" style="color:black">Add AC</li>
                                    </ol>
                                </div>
                                <form method="post" action="{{ url('superadmin/updateups') }}" class="row g-3"
                                    style="margin-top: 15px">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <label for="ups_model">UPS Name</label>
                                    <input type="text" class="form-control" name="ups_model" id="ups_model"
                                        placeholder="Enter Model Name" required  value="{{ $data->ups_model }}">
                                    <label for="ups_capacity">Capacity</label>
                                    <input type="text" class="form-control" name="ups_capacity" id="ups_capacity"
                                        placeholder="Enter serial number" required  value="{{ $data->ups_capacity }}">
                                    <label for="no_batteries">Batteries</label>
                                    <input type="text" class="form-control" name="no_batteries" id="no_batteries"
                                    placeholder="Enter serial number" required  value="{{ $data->no_batteries }}">
                                    <label for="status">Status</label>
                                    <textarea name="status" class="form-control" id="status" cols="30" rows="5"
                                    placeholder="Enter Status">{{ $data->status }}</textarea>
                                        <label for="lab_name" style="margin-top: 15px;">Lab Name</label>
                                        <select name="lab_name" id="lab_name" class="form-control">
                                            <option value="{{ $data->lab_name }}" selected>{{ $data->lab_name }}</option>
                                            @foreach ($labs as $dev)
                                                <option value="{{ $dev->lab_name }}">{{ $dev->lab_name }}</option>
                                            @endforeach
                                        </select>
                                    <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href='{{ url('superadmin/upsload') }}' class="btn btn-danger">Back</a>
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
