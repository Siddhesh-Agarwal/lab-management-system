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
            width:30%;;
        }
    </style>

    <div class="container" style="margin-top: 100px">
        <section class="content">
            <div style="width: max-content">
                <ol class="breadcrumb" >
                    <li class="breadcrumb-item" style="color:black">Other Devices</li>
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
                        setTimeout(function() {
                            $('#error-alert').fadeOut('slow');
                        }, 5000);
                    </script>
                @endif
                <div class="outer">
                <div class="sample">
                    <div class="">
                        <div class="card">
                            <a href={{ route('superadmin.printer') }}>
                            <div class="btn-lg">
                                <div style="width: 250px; margin-inline:auto; margin-top:20px">
                                    <ol class="breadcrumb" style="display: block">
                                        <li class="text-center" style="color:black;">Printer</li>
                                    </ol>
                                </div>
                            </div>
                            </a>
                            <a href={{ route('superadmin.switch') }}>
                            <div class="btn-lg">
                                <div style="width: 250px; margin-inline:auto">
                                    <ol class="breadcrumb" style="display: block">
                                        <li class="text-center" style="color:black;">Network Switches</li>
                                    </ol>
                                </div>
                            </div>
                            </a>
                            <a href={{ route('superadmin.acload') }}>
                            <div class="btn-lg">
                                <div style="width: 250px; margin-inline:auto">
                                    <ol class="breadcrumb" style="display: block">
                                        <li class="text-center" style="color:black;">Ac Load</li>
                                    </ol>
                                </div>
                            </div>
                            </a>
                            <a href={{ route('superadmin.upsload') }}>
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
