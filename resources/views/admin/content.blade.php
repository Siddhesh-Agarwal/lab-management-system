@extends('admin.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-6 col-6">
                                    <div class="description-block border-right">
                                        @if (Session::has('data_box'))
                                            <img src="{{ $data_box['datas']['pic'] }}" alt="User Avatar"
                                                class="img-size-100 img-circle" style="margin-bottom: 20px" width="170px">
                                            <h4 class="description-percentage" style="color: rgb(83, 167, 92)"><i
                                                    class="fas fa-street-view"></i>
                                                <span>{{ $data_box['datas']['name'] }} </span>
                                                <br />
                                                <span class="description-text">{{ $data_box['datas']['degree'] }}</span>
                                                <span class="description-text">{{ $data_box['datas']['branch'] }}</span>
                                            @else
                                                <img src={{ URL::asset('dist/img/Logo.jpg') }} alt="User Avatar"
                                                    class="img-size-100 img-circle" style="margin-bottom: 20px"
                                                    width="170px">
                                                <h4 class="description-percentage" style="color: rgb(83, 167, 92)"><i
                                                        class="fas fa-street-view"></i>
                                                    <span>Username</span>
                                                    <br />
                                                    <span class="description-text">Degree</span>
                                                    <span class="description-text">Branch</span>
                                        @endif


                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6 col-6">
                                    <div class="description-block" style="margin-top: 80px">
                                        <form action={{ route('admin.student.add') }} method="POST">
                                            @csrf
                                            <h2>Roll Number</h2>
                                            <input style="width:50%" type="text" name="rollno" id="rollno">
                                            <input type="text" name="labname"
                                                value={{ urlencode(Auth::user()->labname) }} id="labname" hidden>
                                            <input type="submit" hidden>
                                            <a href={{ route('admin.force') }} class="btn btn-danger" ">
                                                                                        <i class="fas fa-minus"></i> Logout all</a>
                                            </form>
                                                                            </div>
                                                                            <!-- /.description-block -->
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.row -->
                                                                </div>

                                     @if (Session::has('data_box'))
                                                <div class="card-footer" style="background-color: rgb(83, 167, 92)">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-12">
                                                            <div class="description-block ">
                                                                <h1 class="blinking" style="margin:5%">
                                                                    {{ $data_box['message'] }}</h1>
                                                            </div>
                                                            <!-- /.description-block -->
                                                        </div>
                                                        <!-- /.description-block -->
                                                    </div>
                                                </div>
                                                <script>
                                                    setTimeout(function() {
                                                        document.querySelector('.blinking').classList.remove('blinking');
                                                    }, 5000); // Remove blinking class after 5 seconds
                                                </script>
                                                @endif
                                                <!-- /.row -->
                                    </div>
                                    <!-- /.card-footer -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Main row -->
                        <div class="row">
                            <!-- Left col -->
                            <div class="col-md-8">

                                <!-- TABLE: LATEST ORDERS -->
                                <div class="card">
                                    <div class="card-header border-transparent">
                                        <h3 class="card-title">Latest Orders</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table m-0">
                                                <thead>
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>Item</th>
                                                        <th>Status</th>
                                                        <th>Popularity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                                        <td>Call of Duty IV</td>
                                                        <td><span class="badge badge-success">Moved</span></td>
                                                        <td>
                                                            <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                                90,80,90,-70,61,-83,63</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                                        <td>Samsung Smart TV</td>
                                                        <td><span class="badge badge-warning">Pending</span></td>
                                                        <td>
                                                            <div class="sparkbar" data-color="#f39c12" data-height="20">
                                                                90,80,-90,70,61,-83,68</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                                        <td>iPhone 6 Plus</td>
                                                        <td><span class="badge badge-danger">Delivered</span></td>
                                                        <td>
                                                            <div class="sparkbar" data-color="#f56954" data-height="20">
                                                                90,-80,90,70,-61,83,63</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                                        <td>Samsung Smart TV</td>
                                                        <td><span class="badge badge-info">Processing</span></td>
                                                        <td>
                                                            <div class="sparkbar" data-color="#00c0ef" data-height="20">
                                                                90,80,-90,70,-61,83,63</div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer clearfix">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New
                                            Order</a>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All
                                            Orders</a>
                                    </div>
                                    <!-- /.card-footer -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->

                            <div class="col-md-4">
                                <!-- Info Boxes Style 2 -->
                                <div class="info-box mb-3 bg-warning">
                                    <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Student Logins</span>
                                        <span class="info-box-number">5,200</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                                <div class="info-box mb-3 bg-success">
                                    <span class="info-box-icon"><i class="far fa-heart"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Systems</span>
                                        <span class="info-box-number">92,050</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                                <div class="info-box mb-3 bg-danger">
                                    <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Devices</span>
                                        <span class="info-box-number">114,381</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                                <div class="info-box mb-3 bg-info">
                                    <span class="info-box-icon"><i class="far fa-comment"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Random</span>
                                        <span class="info-box-number">163,921</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!--/. container-fluid -->
    </section>
@endsection
