{{-- @extends('superadmin.dashboard')

@section('content')
    <style>
        input {
            margin-bottom: 15px;
        }
    </style>

    <div class="container-fluid">
        <section class="content">
            <div class="row" style="margin-top:120px; ">
                <div class="col-12">
                    <div class="card" style="padding: 30px; width:100%;">
                        <div style="width: max-content">
                            <ol class="breadcrumb" >
                                <li class="breadcrumb-item" style="color:black">Add Other Device</li>
                            </ol>
                        </div>
                        <a href={{ url('superadmin/addprinters') }} class="nav-link">
                        <button>Add Printers</button>
                        </a>
                        <a href={{ url('superadmin/addac') }} class="nav-link">
                        <button>Add AC Load</button>
                        </a>
                        <a href={{ url('superadmin/addups') }} class="nav-link">
                        <button>Add UPS Load</button>
                        </a>
                        <a href={{ url('superadmin/addswitch') }} class="nav-link">
                        <button>Add Network Swtiches</button>
                        </a>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection --}}


@extends('superadmin.dashboard')

@section('content')
    <style>
        table tr,
        table th,
        table td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        .button-actions {
            display: flex;
            flex-direction: row;
        }

        .outer{
            display: flex;
            justify-content: center;
        }
        .sample{
            display: block;
            width: 30%;
        }
    </style>

    <div class="container" style="margin-top: 100px">
        <section class="content">
            <div style="width: max-content">
                <ol class="breadcrumb" >
                    <li class="breadcrumb-item" style="color:black">Add Other Devices</li>
                </ol>
            </div>
            <div class="container-fluid">
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
                        setTirowmeout(function() {
                            $('#error-alert').fadeOut('slow');
                        }, 5000);
                    </script>
                @endif
                <div class="outer">
                <div class="sample">
                    <div class="col-full">
                        <div class="card">
                            <a href={{ url('superadmin/addprinters') }}>
                            <div class="btn-lg">
                                <div style="width: 250px; margin-inline:auto; margin-top:20px">
                                    <ol class="breadcrumb" style="display: block">
                                        <li class="text-center" style="color:black;">Printer</li>
                                    </ol>
                                </div>
                            </div>
                            </a>
                            <a href={{ url('superadmin/addswitch') }}>
                            <div class="btn-lg">
                                <div style="width: 250px; margin-inline:auto">
                                    <ol class="breadcrumb" style="display: block">
                                        <li class="text-center" style="color:black;">Network Switches</li>
                                    </ol>
                                </div>
                            </div>
                            </a>
                            <a href={{ url('superadmin/addac') }}>
                            <div class="btn-lg">
                                <div style="width: 250px; margin-inline:auto">
                                    <ol class="breadcrumb" style="display: block">
                                        <li class="text-center" style="color:black;">Ac Load</li>
                                    </ol>
                                </div>
                            </div>
                            </a>
                            <a href={{ url('superadmin/addups') }}>
                                <div class="btn-lg">
                                    <div style="width: 250px; margin-inline:auto">
                                        <ol class="breadcrumb" style="display: block">
                                            <li class="text-center" style="color:black;">UPS</li>
                                        </ol>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                </div>
            </div>
        </section>
    </div>
@endsection
