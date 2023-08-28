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

    <div class="container">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="margin: 2%; padding:30px">
                            <div style="width: max-content">
                                <ol class="breadcrumb" >
                                    <li class="breadcrumb-item" style="color:black">Add Warranty</li>
                                </ol>
                            </div>
                            <form method="post" action="{{ url('superadmin/savewarranty') }}" class="row g-3">
                                @csrf
                                <label for="warranty_name">Warranty Name</label>
                                <input type="text" class="form-control" id="warranty_name" name="warranty_name"
                                    placeholder="Enter Warranty Name" required>
                               
                                <label for="lab_name" style="margin-top: 5px;">Lab Name</label>
                                <select name="lab_name" id="lab_name" class="form-control">
                                    <option value="" disabled selected>Select Lab Name</option>
                                    @foreach ($labs as $dev)
                                        <option value="{{ $dev->lab_name }}">{{ $dev->lab_name }}</option>
                                    @endforeach
                                </select>
                                <label for="system_number" style="margin-top: 10px;">System Number</label>
                                <select class="form-control" id="system_number" name="system_number" required>
                                    <option value="" disabled selected>Select System Number</option>
                                </select>
                                <label for="time_period" style="margin-top: 10px;">Time Period</label>
                                <input type="date"  class="form-control" id="time_period"
                                    name="time_period" placeholder="Enter TimePeriod" required>
                                
                                <div style="display:flex; justify-content:space-between; width:100%; margin-top:2%">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                    <a href='{{ route('superadmin.warranty') }}'
                                        class="btn btn-danger">Back</a>
                                </div>
                                <script>
                                    const labSelect = document.getElementById('lab_name');
                                    const systemModelSelect = document.getElementById('system_number');

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
                                                defaultOption.textContent = 'Select System Number';
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
