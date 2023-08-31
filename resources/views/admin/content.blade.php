@extends('admin.dashboard')

@section('content')
    <section class="content" style="margin-top: 90px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-6 col-6">
                                    <div class="description-block border-right">
                                        @if (Session::has('data_box'))
                                            <img src="http://results.skcet.ac.in:610/assets/StudentImage/{{ $data_box['datas']['rollno'] }}.jpg"
                                                alt="User Avatar" class="img-size-100 img-circle" width="170px"
                                                style="margin-bottom: 20px">
                                            <h4 class="description-percentage" style="color: rgb(83, 167, 92)">
                                                <i class="fas fa-street-view"></i>
                                                <span>{{ $data_box['datas']['name'] }} </span>
                                            </h4>
                                            <span class="description-text">{{ $data_box['datas']['degree'] }}</span>
                                            <span class="description-text">{{ $data_box['datas']['branch'] }}</span>
                                        @else
                                            <lord-icon src="https://cdn.lordicon.com/ljvjsnvh.json" trigger="loop"
                                                delay="1000" colors="primary:#4be1ec,secondary:#cb5eee" state="hover-1"
                                                style="width:250px;height:250px">
                                            </lord-icon>
                                            <h4 class="description-percentage" style="color: rgba(80, 167, 255, 0.804);"><i
                                                    class="fas fa-smile-o"></i>
                                                <span class="stylish-text">Welcome to {{ Auth::user()->labname }}</span>
                                        @endif
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->

                                <div class="col-sm-6 col-6">
                                    <div class="description-block">
                                        @if (Session::has('data_box'))
                                            @if ($data_box['type'] === 'login')
                                                <lord-icon src="https://cdn.lordicon.com/efdhjqgx.json" trigger="loop"
                                                    colors="primary:#4be1ec,secondary:#cb5eee"
                                                    style="width:220px;height:220px">
                                                </lord-icon>
                                            @else
                                                <lord-icon src="https://cdn.lordicon.com/alnsmmtf.json" trigger="loop"
                                                    colors="primary:#4be1ec,secondary:#cb5eee"
                                                    style="width:220px;height:220px">
                                                </lord-icon>
                                            @endif
                                        @else
                                            <lord-icon src="https://cdn.lordicon.com/efdhjqgx.json" trigger="loop"
                                                colors="primary:#4be1ec,secondary:#cb5eee" style="width:220px;height:220px">
                                            </lord-icon>
                                        @endif
                                        <form action={{ route('admin.student.add') }} method="POST">
                                            @csrf
                                            {{-- Roll number should be converted to uppercase --}}
                                            <div
                                                style="display: flex;width:100%;flex-direction:row; justify-content:center; align-items:center;">
                                                <div id="webflow-style-input">
                                                    <input type="text" name="rollno" id="rollno"
                                                        required
                                                        oninput="convertToUppercase()"
                                                        style="background:transparent;border:none; outline:none; width:100%;"></input>
                                                </div>
                                                <div style="width:max-content; display:flex; align-items:center;">
                                                    <a href={{ route('admin.force') }} class="btn btn-danger"
                                                        style="margin-left: 20px">
                                                        <i class="fa-solid fa-power-off fa-fade fa-lg"></i>
                                                        Logout all
                                                    </a>
                                                </div>
                                            </div>
                                            <input type="text" name="labname"
                                                value={{ urlencode(Auth::user()->labname) }} id="labname" hidden />
                                            <input type="submit" hidden />
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
            <div class="col-md-12">
                <div style="display: flex">
                    <!-- Info Boxes Style 2 -->
                    <div class="info-box mb-3 mr-3" style="background-color: #94589D">
                        <span class="info-box-icon"><i class="fa-solid fa-arrow-right-to-bracket fa-beat-fade fa-lg"
                                style="color: #ffffff;--fa-beat-scale: 1.5;"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text" style="color: white">Student Logins</span>
                            <span class="info-box-number">{{ $login_count }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-success">
                        <span class="info-box-icon"><i class="fa-solid fa-computer fa-beat-fade fa-lg"
                                style="color: #ffffff;--fa-beat-scale: 1.5;"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Systems</span>
                            <span class="info-box-number">{{ $systemcount }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                <div style="display: flex">
                    <!-- /.info-box -->
                    <div class="info-box mb-3 mr-3 bg-danger">
                        <span class="info-box-icon"><i class="fa-solid fa-keyboard fa-beat-fade fa-lg"
                                style="color: #ffffff;--fa-beat-scale: 1.5;"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Devices</span>
                            <span class="info-box-number">{{ $devicecount }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-info">
                        <span class="info-box-icon"><i class="fa-solid fa-building-user fa-beat-fade fa-lg"
                                style="color: #ffffff;--fa-beat-scale: 1.5;"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Laptops</span>
                            <span class="info-box-number">{{ $laptopcount }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
        <!--/. container-fluid -->
    </section>
    <script>
        function convertToUppercase() {
            var inputElement = document.getElementById("rollno");
            inputElement.value = inputElement.value.toUpperCase();
        }
    </script>
@endsection
