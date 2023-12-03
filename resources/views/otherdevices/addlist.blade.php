@extends('superadmin.dashboard')

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
@endsection
