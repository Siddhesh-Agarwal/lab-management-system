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
                                        <li class="breadcrumb-item" style="color:black">Add System</li>
                                    </ol>
                                </div>
                                <form method="post" action="{{ url('admin/savelablistdevice') }}" class="row g-3"
                                    style="margin-top:40px; ">
                                    @csrf
                                    <label for="device_name">Device name</label>
                                    <input type="text" class="form-control" name="device_name" id="device_name"
                                        placeholder="Enter Device Name" required>
                                    <label for="spec">Spec</label>
                                    <input type="text" class="form-control" name="spec" id="spec"
                                        placeholder="Enter Spec" required>
                                    <label for="system_number">System Number</label>
                                    <input type="text" class="form-control" name="system_number" id="system_number"
                                        placeholder="Enter System Number" required>
                                    <label for='desc'>System Description</label>
                                    <textarea name="desc" class="form-control" id="desc" cols="20" rows="5"
                                        placeholder="Enter Description"></textarea>
                                    <input type="text" hidden value={{ urlencode(Auth::user()->labname) }} id="lab_name"
                                        name="lab_name">
                                    <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        <a href='{{ route('admin.lablist', ['lab_name' => Auth::user()->labname]) }}'
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
