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
                                                <img src={{ URL::asset('dist/img/placeholder.png') }} alt="User Avatar"
                                                    class="img-size-100 img-circle" style="margin-bottom: 20px"
                                                    width="170px">
                                                <h4 class="description-percentage" style="color: rgb(253, 159, 19)"><i
                                                        class="fas fa-smile-o"></i>
                                                    <span>Welcome to {{ Auth::user()->labname }}</span>
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
                                            {{-- Roll number should be converted to uppercase --}}
                                            <input style="width:50%" type="text" name="rollno" id="rollno" required />
                                            <input type="text" name="labname"
                                                value={{ urlencode(Auth::user()->labname) }} id="labname" hidden />
                                            <input type="submit" hidden />
                                            <a href={{ route('admin.force') }} class="btn btn-danger" ">
                                                <i class="fas fa-minus"></i>
                                                Logout all
                                            </a>
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
                                                    {{ $data_box['message'] }}
                                                </h1>
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
                            @if (Session::has('message'))
                                <div class="card-footer" style="background-color: rgb(83, 167, 92)">
                                    <div class="row">
                                        <div class="col-sm-12 col-12">
                                            <div class="description-block ">
                                                <h1 class="blinking" style="margin:5%">
                                                    {{ Session::get('message') }}
                                                </h1>
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
                <!-- /.col -->
                @if (Session::has('data_box'))
                    <div class="col-md-12">
                        <div style="display: flex">
                            <!-- Info Boxes Style 2 -->
                            <div class="info-box mb-3 mr-3 bg-warning">
                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Student Logins</span>
                                    <span class="info-box-number">{{ $data_box['logins'] }}</span>
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
                        </div>
                        <div style="display: flex">
                            <!-- /.info-box -->
                            <div class="info-box mb-3 mr-3 bg-danger">
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
                    </div>
                @endif
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!--/. container-fluid -->
    </section>
@endsection
