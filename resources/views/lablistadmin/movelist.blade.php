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
    
    <h2>Update Devices</h2>

    <form id="exchangeForm" method="post" action="{{ url('admin/save-labmove') }}" class="row g-3">
        @csrf

        <label for="device_name">Device Name:</label>
        <input type="text" class="form-control" name="device_name" value="{{ $data->device_name }}" readonly>
        <label for="spec">Spec:</label>
        <input type="text" class="form-control" name="spec" value="{{ $data->spec }}" readonly>
        <label for="system_number">System Number:</label>
        <input type="text" class="form-control" name="system_number" value="{{ $data->system_number }}" readonly>
        <label for="desc">System Description:</label>
        <textarea type="text" class="form-control" name="desc" readonly>{{ $data->desc }} </textarea>
        <input type="hidden" name="id" value="{{ $data->id }}">
        <label for="source">Lab Name:</label>
        <input type="text" class="form-control" id="source" name="source" placeholder="Enter Lab Name"
            value="{{ $data->lab_name }}" readonly>
        <label for="destination">Exchange Name:</label>
        <select name="destination" id="destination" class="form-control">
            <option value="Alan Kay">Alan Kay Lab</option>
            <option value="Nicklaus Writh">Nicklaus
                Writh
                Lab</option>
            <option value="John Backus">John Backus Lab
            </option>
            <option value="Djikstra Lab">Djikstra Lab
            </option>
            <option value="Donald Knuth">Donald Knuth
                Lab
            </option>
            <option value="EF Codd">EF Codd Lab</option>
            <option value="Jimgray">Jimgray Lab</option>
            <option value="DSP VLSI">DSP VLSI Lab</option>
        </select>
        <button type="submit" class="btn btn-primary">Exchange</button>
        <hr>
        <a href='{{ route('admin.lablist', ['lab_name' => urlencode(Auth::user()->labname)]) }}'
            class="btn btn-danger">Back</a>

    </form>
@endsection