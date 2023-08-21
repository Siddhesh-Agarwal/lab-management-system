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

    <section class="content" style="margin: 20px">
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


        <form method="post" action="{{ url('superadmin/savelistdevice') }}" class="row g-3" style="margin-top:110px; ">
            @csrf

            <label for="device_name">Device Name</label>
            <input type="text" class="form-control" id="device_name" name="device_name" placeholder="Enter Device Name"
                required>
            <label for="serial_number">Serial Number</label>
            <input type="text" class="form-control" id="serial_number" name="serial_number"
                placeholder="Enter Serial Number">
            <label for="lab_name" style="margin-top: 5px;">Lab Name</label>
            <select name="lab_name" id="lab_name" class="form-control">
                <option value="" disabled selected>Select Lab Name</option>
                @foreach ($labs as $dev)
                    <option value="{{ $dev->lab_name }}">{{ $dev->lab_name }}</option>
                @endforeach
            </select>
            <label for="system_model_number" style="margin-top: 10px;">System Model Number</label>
            <select class="form-control" id="system_model_number" name="system_model_number" required>
                <option value="" disabled selected>Select System Model Number</option>
            </select>
            <label for="count" style="margin-top: 10px;">Count</label>
            <input type="number" min="1" value="1" class="form-control" id="count" name="count"
                placeholder="Enter Count" required>
            <label for="desc">Service Description</label><br>
            <textarea type="text" class="form-control" id="desc" name="desc" placeholder="Enter desc" rows="4"
                cols="50"></textarea><br>

            <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
                <button type="submit" class="btn btn-primary">Add</button>
                <a href='{{ route('superadmin.lablistdevices', ['lab_name' => Auth::user()->labname]) }}'
                    class="btn btn-danger">Back</a>
            </div>
            <script>
                const labSelect = document.getElementById('lab_name');
                const systemModelSelect = document.getElementById('system_model_number');

                labSelect.addEventListener('change', function() {
                    const selectedLab = labSelect.value;


                    fetch(`/superadmin/getSystemNumbers/${selectedLab}`)
                        .then(response => response.json())
                        .then(data => {
                            // Clear existing options
                            systemModelSelect.innerHTML = '';

                            // Add default disabled option
                            const defaultOption = document.createElement('option');
                            defaultOption.value = '';
                            defaultOption.textContent = 'Select System Model Number';
                            defaultOption.disabled = true;
                            defaultOption.selected = true;
                            systemModelSelect.appendChild(defaultOption);

                            // Add available options
                            data.forEach(systemModel => {
                                const option = document.createElement('option');
                                option.value = systemModel;
                                option.textContent = systemModel;
                                systemModelSelect.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error fetching system numbers:', error);
                        });
                });
            </script>
        </form>
    </section>
@endsection
