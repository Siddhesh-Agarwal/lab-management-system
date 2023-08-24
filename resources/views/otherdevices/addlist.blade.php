@extends('superadmin.dashboard')

@section('content')
    <style>
        input {
            margin-bottom: 15px;
        }

        body {
            margin: 45px;
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


    <div class="container-fluid">
        <section class="content">
            <div class="row" style="margin-top:120px; ">
                <div class="col-12">
                    <div class="card" style="padding: 30px; width:100%;"">
                        <div style="width: max-content">
                            <ol class="breadcrumb" style="background-color:#FC9E4F">
                                <li class="breadcrumb-item" style="color:black">Add Other Device</li>
                            </ol>
                        </div>
                        <form method="post" action="{{ url('superadmin/saveotherdevice') }}" class="row g-3">
                            @csrf
                            <label for="network_switches">Network Switches</label>
                            <input type="number" class="form-control" name="network_switches" id="network_switches"
                                placeholder="Enter Network Switches" required>
                            <label for="ups_load">Ups Load</label>
                            <input type="number" class="form-control" name="ups_load" id="ups_load"
                                placeholder="Enter ups load" required>
                            <label for="ac_load">AC Load</label>
                            <input type="number" class="form-control" name="ac_load" id="ac_load"
                                placeholder="Enter AC load" required>
                            <label for='wifi_access_poitns'>Wifi Access Point</label>
                            <input name="wifi_access_points" class="form-control" id="wifi_access_poitns" type="number"
                                placeholder="Enter Wifi access point"></input>
                            {{-- <input type="text" hidden value={{ Auth::user()->labname }} id="lab_name" name="lab_name"> --}}
                            <label for="lab_name">Lab Name</label>
                            <select name="lab_name" id="lab_name" class="form-control">
                                @foreach ($labs as $dev)
                                    <option value="{{ $dev->lab_name }}">{{ $dev->lab_name }}</option>
                                @endforeach
                            </select>
                            <div
                                style="margin-top: 20px; display:flex; justify-content:space-between; align-items:center; width:100%">
                                <div>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                                <div>
                                    <a href='{{ url('superadmin/otherdevice') }}' class="btn btn-danger">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
