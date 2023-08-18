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

    <body>

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


        <form method="post" action="{{ url('superadmin/saveotherdevice') }}" class="row g-3">
            @csrf

            <lable for="network_switches">Netwok Switches</lable>
            <input type="number" class="form-control" name="network_switches" id="network_switches"
                placeholder="Enter Network Switches" required>
            <lable for="ups_load">Ups Load</lable>
            <input type="number" class="form-control" name="ups_load" id="ups_load" placeholder="Enter ups load" required>
            <lable for="ac_load">AC Load</lable>
            <input type="number" class="form-control" name="ac_load" id="ac_load" placeholder="Enter AC load" required>
            <lable for='wifi_access_poitns'>Wifi Access Point</lable>
            <input name="wifi_access_points" class="form-control" id="wifi_access_poitns" type="number"
                placeholder="Enter Wifi access point"></input>
            {{-- <input type="text" hidden value={{ Auth::user()->labname }} id="lab_name" name="lab_name"> --}}
            <label for="lab_name">Lab Name:</label>
            <select name="lab_name" id="lab_name" class="form-control">
                <option value="Alan Kay" {{ Auth::user()->labname === 'Alan Kay' ? 'selected' : '' }}>Alan Kay Lab</option>
                <option value="Nicklaus Writh" {{ Auth::user()->labname === 'Nicklaus Writh' ? 'selected' : '' }}>Nicklaus
                    Writh
                    Lab</option>
                <option value="John Backus" {{ Auth::user()->labname === 'John Backus' ? 'selected' : '' }}>John Backus Lab
                </option>
                <option value="Djikstra" {{ Auth::user()->labname === 'Djikstra' ? 'selected' : '' }}>Djikstra Lab
                </option>
                <option value="Donald Knuth" {{ Auth::user()->labname === 'Donald Knuth' ? 'selected' : '' }}>Donald Knuth
                    Lab
                </option>
                <option value="EF Codd" {{ Auth::user()->labname === 'EF Codd' ? 'selected' : '' }}>EF Codd Lab</option>
                <option value="Jimgray" {{ Auth::user()->labname === 'Jimgray' ? 'selected' : '' }}>Jimgray Lab</option>
                <option value="DSP VLSI" {{ Auth::user()->labname === 'DSP VLSI' ? 'selected' : '' }}>DSP VLSI Lab</option>
            </select>
            <div style="margin-top: 20px; display:flex; justify-content:space-between; align-items:center; width:100%">
                <div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                <div>
                    <a href='{{ url('superadmin/otherdevice') }}' class="btn btn-danger">Back</a>
                </div>
            </div>

        </form>
    @endsection
