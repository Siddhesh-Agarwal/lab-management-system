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
                                        <li class="breadcrumb-item" style="color:black">Update Other Device</li>
                                    </ol>
                                </div>
                                <form method="post" action="{{ url('admin/updateotherdevice') }}" class="row g-3"
                                    style="margin-top: 40px">
                                    @csrf
                                    <label for="network_switches">Network Switches</label>
                                    <input type="number" class="form-control" name="network_switches"
                                        value="{{ $data->network_switches }}">
                                    <label for="ups_load">Ups Load</label>
                                    <input type="number" class="form-control" name="ups_load"
                                        value="{{ $data->ups_load }}">
                                    <label for="ac_load">Ac Load</label>
                                    <input type="number" class="form-control" name="ac_load" value="{{ $data->ac_load }}">
                                    <label for="wifi_access_points">Wifi Access Point</label>
                                    <input type="number" class="form-control" name="wifi_access_points"
                                        value="{{ $data->wifi_access_points }}">
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <input type="text" hidden value={{ urlencode(Auth::user()->labname) }} id="lab_name"
                                        name="lab_name">
                                    <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href='{{ route('admin.otherdevice', ['lab_name' => Auth::user()->labname]) }}'
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
