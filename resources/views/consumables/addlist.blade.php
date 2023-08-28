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
                <div class="row" style="margin-top:120px; ">
                    <div class="col-12">
                        <div class="card" style="padding: 30px; width:100%;">
                            <div style="width: max-content">
                                <ol class="breadcrumb" >
                                    <li class="breadcrumb-item" style="color:black">Add Consumables</li>
                                </ol>
                            </div>
                            <form method="post" action="{{ url('superadmin/consumables/save') }}" class="row g-3"
                                style="width:100%">
                                @csrf
                                <label for="device_name">Device Name</label>
                                <input type="text" class="form-control" name="device_name" id="device_name"
                                    placeholder="Enter Device Name" required>        
                                <label for="serial_number">Serial Number</label>
                                <input type="text" class="form-control" name="serial_number" id="serial_number"
                                    placeholder="Enter Serial Number" required>
                                    
                                    <label for="count" style="margin-top: 10px;">Count</label>
                                    <input type="number" min="1" value="1" class="form-control" id="count"
                                        name="count" placeholder="Enter Count" required>
                                <label for="lab_name" style="margin-top: 15px;">Lab Name</label>
                                <select name="lab_name" id="lab_name" class="form-control">
                                    <option value=""></option>
                                    @foreach ($labs as $dev)
                                        <option value="{{ $dev->lab_name }}">{{ $dev->lab_name }}</option>
                                    @endforeach
                                </select>
                                <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                    <a href='{{ route('superadmin.list.consumables') }}' class="btn btn-danger">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
