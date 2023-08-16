<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>
<style>
    table tr,
    table th,
    table td {
        border: 1px solid #ccc;
        padding: 10px;
    }

    table tr {
        background-color: #e7e5de;
    }

    table th {
        color: black;
    }
</style>

<body>
    <div class="container" style='magin-top:20px'>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif
        <div class="row">
            <div class="column">

                <table class="table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Device</th>
                            <th>Serial No</th>
                            <th>System</th>
                            <th>Count</th>
                            <th>Service Details</th>
                            <th>Lab name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $dev)
                            <tr>
                                <td>{{ $dev->id }}</td>
                                <td>{{ $dev->device_name }}</td>
                                <td>{{ $dev->serial_number }}</td>
                                <td>{{ $dev->system_model_number }}</td>
                                <td>{{ $dev->count }}</td>
                                <td>{{ $dec->desc }}</td>
                                <td>{{ $dev->lab_name }}</td>
                                <td><a href="{{ url('superadmin/deletelist/' . $dev->id) }}"
                                        class="btn btn-danger">Delete</a></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
