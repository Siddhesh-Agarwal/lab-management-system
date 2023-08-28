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
                                    <li class="breadcrumb-item" style="color:black">Edit Warranty</li>
                                </ol>
                            </div>
                            <form method="post" action="{{ url('superadmin/updatewarranty') }}" class="row g-3">
                                @csrf
                                <label for="warranty_name">Warranty name</label>
                                <input type="text" class="form-control" name="warranty_name"
                                    value="{{ $data->warranty_name }}">
                               
                                <label for="system_number">System Number</label>
                                <input type="text" class="form-control" name="system_number"
                                    value="{{ $data->system_number }}">
                                
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <label for="lab_name" style="margin-top: 10px">Lab Name</label>
                                <select name="lab_name" id="lab_name" class="form-control">
                                    <option value="{{ $data->labname }}" selected>{{ $data->labname }}</option>
                                    @foreach ($labs as $dev)
                                    @if ($data->labname!=$dev->lab_name)
                                        <option value="{{ $dev->lab_name }}">{{ $dev->lab_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="time_period" style="margin-top: 10px;">Time Period</label>
                                <input type="date"  class="form-control" id="time_period"
                                    name="time_period" placeholder="Enter TimePeriod" value="{{ $data->time_period }}" required >
                                
                                <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href='{{ url('superadmin/warranty') }}' class="btn btn-danger">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
