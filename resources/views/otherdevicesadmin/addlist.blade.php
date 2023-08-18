@extends('admin.dashboard')

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

        @if (Session::has('success'))
            <div class="alert alert-success" role=alert>
                {{ Session::get('success') }}
            </div>
        @endif

        <form method="post" action="{{ url('admin/saveotherdevice') }}" class="row g-3">
            @csrf

            <label for="network_switches">Netwok Switches</label>
            <input type="number" class="form-control" name="network_switches" id="network_switches"
                placeholder="Enter Network Switches" required>
            <label for="ups_load">Ups Load</label>
            <input type="number" class="form-control" name="ups_load" id="ups_load" placeholder="Enter ups load" required>
            <label for="ac_load">AC Load</label>
            <input type="number" class="form-control" name="ac_load" id="ac_load" placeholder="Enter AC load" required>
            <label for='wifi_access_poitns'>Wifi Access Point</label>
            <input name="wifi_access_points" class="form-control" id="wifi_access_poitns" type="number"
                placeholder="Enter Wifi access point" required></input>
            <input type="text" value={{ urlencode(Auth::user()->labname) }} id="lab_name" name="lab_name" hidden>
            <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
                <button type="submit" class="btn btn-primary">Add</button>
                <a href='{{ url('admin/otherdevice') }}' class="btn btn-danger">Back</a>
            </div>
        </form>
    @endsection
