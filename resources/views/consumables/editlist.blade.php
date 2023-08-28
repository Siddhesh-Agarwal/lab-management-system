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

    <section class="content">
        <div class="container">
            <div class="container-fluid">
                <div class="row" style="margin-top:100px;">
                    <div class="col-12">
                        <div class="card" style="margin: 1%">
                            <div class="card-header">
                                <div style="width: max-content">
                                    <ol class="breadcrumb" >
                                        <li class="breadcrumb-item" style="color:black">Update Consumables</li>
                                    </ol>
                                </div>
                                <form method="post" action="{{ url('superadmin/consumables/update') }}" class="row g-3">
                                    @csrf
                                    <input class="input" type="hidden" name="id" value="{{ $data->id }}">
                                    <label for="device_name">Device Name</label>
                                    <input type="text" class="form-control" id="device_name" name="device_name"
                                        placeholder="Enter Device Name" required value="{{ $data->device_name }}">
                                    <label for="serial_number">Serial Number</label>
                                    <input type="text" class="form-control" id="serial_number" name="serial_number"
                                        placeholder="Enter Serial Number" value="{{ $data->serial_number }}">
                                    
                                    <label for="count">Count</label>
                                    <input type="number" min="0" class="form-control" id="count" name="count"
                                        placeholder="Enter Count" required value="{{ $data->count }}">
                                    <label for="lab_name" style="margin-top: 15px;">Lab Name</label>
                                    <select name="lab_name" id="lab_name" class="form-control">
                                        <option value="{{ $data->labname }}">{{ $data->labname }}</option>
                                        @foreach ($labs as $dev)
                                            <option value="{{ $dev->lab_name }}">{{ $dev->lab_name }}</option>
                                        @endforeach
                                        <option value="None">None</option>
                                    </select>
                                    <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href='{{ route('superadmin.list.consumables') }}' class="btn btn-danger">Back</a>
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
