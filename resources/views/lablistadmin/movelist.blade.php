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

    

    <form id="exchangeForm" method="post" action="{{ url('admin/save-labmove') }}" class="row g-3">
        @csrf

        <label for="device_name">Device Name</label>
        <input type="text" class="form-control" name="device_name" value="{{ $data->device_name }}" readonly>
        <label for="spec">Spec</label>
        <input type="text" class="form-control" name="spec" value="{{ $data->spec }}" readonly>
        <label for="system_number">System Number</label>
        <input type="text" class="form-control" name="system_number" value="{{ $data->system_number }}" readonly>
        <label for="desc">System Description</label>
        <textarea type="text" class="form-control" name="desc" >{{ $data->desc }} </textarea>
        <input type="hidden" name="id" value="{{ $data->id }}">
        <label for="source" hidden>Lab Name:</label>
        <input type="text" class="form-control" id="source" name="source" placeholder="Enter Lab Name"
            value="{{ $data->lab_name }}" readonly hidden>
            <label for="destination" style="margin-top: 15px;">Exchange Lab</label>
            <select name="destination" id="destination" class="form-control">
                @foreach ($labNames as $dev)
                @if ($dev->lab_name !== $data->lab_name)
                        <option value="{{ $dev->lab_name }}">{{ $dev->lab_name }}</option>
                    @endif
                @endforeach
            </select>
        <button type="submit" class="btn btn-primary" style="margin-top: 15px;">Exchange</button>
        <hr>
          <a href='{{ route('admin.lablist', ['lab_name' => Auth::user()->labname]) }}'
                        class="btn btn-danger" style="margin-top: 15px;">Back</a>

    </form>
@endsection 
