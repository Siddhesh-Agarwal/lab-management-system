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
    @if (session('success '))
        <script>
            toastr.success('{{ Session::get('success') }}');
        </script>
    @endif

    @if (session('error'))
        <script>
            toastr.error('{{ Session::get('notification') }}');
        </script>
    @endif

    <body>

        @if (Session::has('success'))
            <div class="alert alert-success" role=alert>
                {{ Session::get('success') }}
            </div>
        @endif

        <form method="post" action="{{ url('admin/saveotherdevice') }}" class="row g-3">
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
                placeholder="Enter Wifi access point" required></input>
            <input type="text" value={{ urlencode(Auth::user()->labname) }} id="lab_name" name="lab_name" hidden>
            <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
                <button type="submit" class="btn btn-primary">Add</button>
                <a href='{{ url('admin/otherdevice') }}' class="btn btn-danger">Back</a>
            </div>
        </form>
    @endsection
