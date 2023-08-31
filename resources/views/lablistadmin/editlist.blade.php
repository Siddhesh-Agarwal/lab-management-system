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
    <section class="content" style="margin-top: 100px">
        <div class="container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="padding: 30px; width:100%;">
                            <div style="width: max-content">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item" style="color:black">Update Devices</li>
                                </ol>
                            </div>
                            <form method="post" action="{{ url('admin/updatelablistdevice') }}" class="row g-3">
                                @csrf
                                <label for="device_name">Device name</label>
                                <input type="text" class="form-control" name="device_name"
                                    value="{{ $data->device_name }}">
                                <label for="spec">Spec</label>
                                <input type="text" class="form-control" name="spec" value="{{ $data->spec }}">
                                <label for="system_number">System Number</label>
                                <input type="text" class="form-control" name="system_number"
                                    value="{{ $data->system_number }}">
                                <label for="type">Type</label>
                                <select name="type" id="name" class="form-control">
                                    <option value={{ $data->type }}>{{ $data->type }}</option>
                                    @if ($data->type == 'Laptop')
                                        <option value="Desktop">Desktop</option>
                                    @endif
                                    @if ($data->type == 'Desktop')
                                        <option value="Laptop">Laptop</option>
                                    @endif
                                </select>
                                <label for="desc" style="margin-top: 10px">System Description</label>
                                <textarea type="text" class="form-control" name="desc">{{ $data->desc }}</textarea>
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <input type="text" hidden value={{ urlencode(Auth::user()->labname) }} id="lab_name"
                                    name="lab_name">
                                <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href='{{ route('admin.lablist', ['lab_name' => Auth::user()->labname]) }}'
                                        class="btn btn-danger">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
