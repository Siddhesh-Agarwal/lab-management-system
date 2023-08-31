@extends('superadmin.dashboard')

@section('content')
    <section class="content">
        <div class="container">
            <div class="container-fluid">
                <div class="row" style="margin-top:100px;">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Admin</h3>
                            </div>
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
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action={{ route('superadmin.update.admin', $user->id) }} method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputName">Name</label>
                                        <input type="text" name="name" class="form-control" value={{ $user->name }}>
                                        @error('name')
                                            <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                <span style="padding-left: 5px">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail">Email</label>
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail"
                                            value={{ $user->email }}>
                                        @error('email')
                                            <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                <span style="padding-left: 5px">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Password</label>
                                        <input type="text" name="password" id="password" class="form-control"
                                            value="{{ $password }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputRole">Role</label>
                                        <select name="role" id="role" class="form-control">
                                            <option value="admin" selected>Admin</option>
                                            <option value="superadmin">Super Admin</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="labname">Lab Name:</label>
                                        <select name="labname" id="labname" class="form-control">
                                            <option value="{{ $user->labname }}" selected>{{ $user->labname }}</option>
                                            @foreach ($labs as $dev)
                                                <option value="{{ $dev->lab_name }}">{{ $dev->lab_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('labname')
                                            <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                <span style="padding-left: 5px">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
