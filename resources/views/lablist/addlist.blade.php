@extends('superadmin.dashboard')

@section('content')
    <style>
        input {
            margin-bottom: 15px;
        }

        .alert {
            background-color: rgb(177, 237, 150);
            width: 30%;
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
                                <ol class="breadcrumb" style="background-color:#FC9E4F">
                                    <li class="breadcrumb-item" style="color:black">Add System</li>
                                </ol>
                            </div>
                            <form method="post" action="{{ url('superadmin/savelablistdevice') }}" class="row g-3"
                                style="width:100%">
                                @csrf
                                <label for="device_name">Device Name</label>
                                <input type="text" class="form-control" name="device_name" id="device_name"
                                    placeholder="Enter Device Name" required>
                                <label for="spec">Spec</label>
                                <input type="text" class="form-control" name="spec" id="spec"
                                    placeholder="Enter Spec" required>
                                <label for="system_number">System Number</label>
                                <input type="text" class="form-control" name="system_number" id="system_number"
                                    placeholder="Enter System Number" required>
                                <label for='desc'>System Description</label>
                                <textarea name="desc" class="form-control" id="desc" cols="30" rows="5"
                                    placeholder="Enter Description"></textarea>
                                <label for="lab_name" style="margin-top: 15px;">Lab Name</label>
                                <select name="lab_name" id="lab_name" class="form-control">
                                    @foreach ($labs as $dev)
                                        <option value="{{ $dev->lab_name }}">{{ $dev->lab_name }}</option>
                                    @endforeach
                                </select>
                                {{-- <label for="lab_name">Lab Name:</label>
            <select name="lab_name" id="lab_name" class="form-control">
                <option value="Alan Kay">Alan Kay Lab</option>
                <option value="Nicklaus Writh">Nicklaus
                    Writh
                    Lab</option>
                <option value="John Backus">John Backus Lab
                </option>
                <option value="Djikstra">Djikstra Lab
                </option>
                <option value="Donald Knuth">Donald Knuth
                    Lab
                </option>
                <option value="EF Codd">EF Codd Lab</option>
                <option value="Jimgray">Jimgray Lab</option>
                <option value="DSP VLSI">DSP VLSI Lab</option>
            </select> --}}
                                <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                    <a href='{{ url('superadmin/lablist') }}' class="btn btn-danger">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
