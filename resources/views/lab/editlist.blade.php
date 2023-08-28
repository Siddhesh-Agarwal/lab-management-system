@extends('admin.dashboard')

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
                                        <li class="breadcrumb-item" style="color:black">Update System</li>
                                    </ol>
                                </div>
                                <form method="post" action="{{ url('admin/updatelistdevice') }}" class="row g-3"
                                    style="margin-top:40px; ">
                                    @csrf
                                    <input class="input" type="hidden" name="id" value="{{ $data->id }}">
                                    <label for="device_name">Device name</label>
                                    <input type="text" class="form-control" id="device_name" name="device_name"
                                        placeholder="Enter Device Name" required value="{{ $data->device_name }}">
                                    <label for="serial_number">Serial Number</label>
                                    <input type="text" class="form-control" id="serial_number" name="serial_number"
                                        placeholder="Enter Serial Number" value="{{ $data->serial_number }}">
                                    <label for="system_model_number">System Number</label>
                                    <select class="form-control" name="system_model_number" id="system_model_number"
                                        required>
                                        <option value="{{ $data->system_model_number }}">
                                            {{ $data->system_model_number }}</option>
                                        @foreach ($systemNumbers as $systemNumber)
                                            @if ($systemNumber !== $data->system_model_number)
                                                <option value="{{ $systemNumber }}">{{ $systemNumber }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label for="count" style="margin-top: 15px;">Count</label>
                                    <input type="number" min="0" class="form-control" id="count" name="count"
                                        placeholder="Enter Count" required value="{{ $data->count }}">
                                    <label for="desc">Service Description</label>
                                    <textarea type="text" class="form-control" id="desc" name="desc" rows="4" cols="50">{{ $data->desc }}</textarea>
                                    <input type="text" hidden value={{ urlencode(Auth::user()->labname) }}
                                        id="lab_name" name="lab_name">
                                    <div div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href='{{ route('admin.listdevice', ['lab_name' => Auth::user()->labname]) }}'
                                            class="btn btn-danger">Back</a>
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
