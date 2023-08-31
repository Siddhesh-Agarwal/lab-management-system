@extends('admin.dashboard')

@section('content')
    <style>
        input {
            margin-bottom: 15px;
        }
    </style>

    <section class="content">
        <div class="container">
            <div class="container-fluid">
                <div class="row" style="margin-top:100px;">
                    <div class="col-12">
                        <div class="card" style="margin: 1%">
                            <div class="card-header">
                                <div style="width: max-content">
                                    <ol class="breadcrumb" >
                                        <li class="breadcrumb-item" style="color:black">Request to Maintenance</li>
                                    </ol>
                                </div>
                                <form method="POST" action="{{ url('admin/labs/movetotemp') }}" class="row g-3">
                                    @csrf
                                    <input class="input" type="hidden" name="id" value="{{ $data->id }}">
                                    <label for="device_name">Device Name</label>
                                    <input type="text" class="form-control" id="device_name" name="device_name"
                                        placeholder="Enter Device Name" required value="{{ $data->device_name }}" readonly>
                                    <label for="serial_number">Serial Number</label>
                                    <input type="text" class="form-control" id="serial_number" name="serial_number"
                                        placeholder="Enter Serial Number" value="{{ $data->serial_number }}" readonly>
                                    <label for="system_model_number">System Model Number</label>
                                    <input type="text" class="form-control" id="system_model_number"
                                        name="system_model_number" placeholder="Enter System Model Number" required
                                        value="{{ $data->system_model_number }}" readonly>
                                    <label for="count">Count</label>
                                    <input type="number" min="1" max="{{ $data->count }}" class="form-control"
                                        id="count" name="count" placeholder="Enter Count" required
                                        value="{{ $data->count }}">
                                    <label for="desc">Service Description</label>
                                    <textarea type="text" class="form-control" id="desc" name="desc" rows="4" cols="50">{{ $data->desc }}</textarea>    
                                    <input type="text" class="form-control" id="lab_name" name="lab_name"
                                        placeholder="Enter Lab Name" required value="{{ $data->lab_name }}" hidden>
                                    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Add Request</button>
                                    <hr>
                                    <a href='{{ route('admin.listdevice', ['lab_name' => Auth::user()->labname]) }}'
                                        class="btn btn-danger" style="margin-top: 20px;">Back</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
