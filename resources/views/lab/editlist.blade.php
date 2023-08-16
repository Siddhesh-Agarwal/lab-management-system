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
    @if (Session::has('notification'))
        <script>
            toastr.success('{{ Session::get('notification') }}');
        </script>
    @endif

    <form method="post" action="{{ url('admin/updatelistdevice') }}" class="row g-3">
        @csrf

        <input class="input" type="hidden" name="id" value="{{ $data->id }}">
        <label for="device_name">Device Name:</label>
        <input type="text" class="form-control" id="device_name" name="device_name" placeholder="Enter Device Name"
            required value="{{ $data->device_name }}">
        <label for="serial_number">Serial Number:</label>
        <input type="text" class="form-control" id="serial_number" name="serial_number" placeholder="Enter Serial Number"
            value="{{ $data->serial_number }}">
        <label for="system_model_number">System Model Number:</label>
        <input type="text" class="form-control" id="system_model_number" name="system_model_number"
            placeholder="Enter System Model Number" required value="{{ $data->system_model_number }}">
        <label for="count">Count:</label>
        <input type="number" min="0" class="form-control" id="count" name="count" placeholder="Enter Count"
            required value="{{ $data->count }}">
        <label for="desc">Service Description:</label>
        <textarea type="text" class="form-control" id="desc" name="desc" rows="4" cols="50">{{ $data->desc }}</textarea>
        <select name="lab_name" id="lab_name" class="form-control">
            <option value="Alan Kay" {{ Auth::user()->labname === 'Alan Kay' ? 'selected' : '' }}>Alan Kay Lab</option>
            <option value="Nicklaus Writh" {{ Auth::user()->labname === 'Nicklaus Writh' ? 'selected' : '' }}>Nicklaus
                Writh
                Lab</option>
            <option value="John Backus" {{ Auth::user()->labname === 'John Backus' ? 'selected' : '' }}>John Backus Lab
            </option>
            <option value="Djikstra Lab" {{ Auth::user()->labname === 'Djikstra Lab' ? 'selected' : '' }}>Djikstra Lab
            </option>
            <option value="Donald Knuth" {{ Auth::user()->labname === 'Donald Knuth' ? 'selected' : '' }}>Donald Knuth
                Lab
            </option>
            <option value="EF Codd" {{ Auth::user()->labname === 'EF Codd' ? 'selected' : '' }}>EF Codd Lab</option>
            <option value="Jimgray" {{ Auth::user()->labname === 'Jimgray' ? 'selected' : '' }}>Jimgray Lab</option>
            <option value="DSP VLSI" {{ Auth::user()->labname === 'DSP VLSI' ? 'selected' : '' }}>DSP VLSI Lab</option>
        </select>
        <div div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href='{{ route('admin.listdevice', ['lab_name' => Auth::user()->labname]) }}'
                class="btn btn-danger">Back</a>
        </div>

    </form>
@endsection