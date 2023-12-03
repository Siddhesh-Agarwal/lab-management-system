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
    </style>

    <div class="container" style="margin-top: 100px">
        <section class="content">
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <h1>Printer</h1>
                           
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </section>
    </div>
@endsection
