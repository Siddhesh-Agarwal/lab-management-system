@extends('superadmin.dashboard')

@section('content')
    <section class="content" style="margin-top: 100px;">
        <div class="container">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Admin</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action={{ route('superadmin.add.admin') }} method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputName">Name</label>
                                <input required type="text" name="name" class="form-control" placeholder="Enter name"
                                    value={{ old('name') }}>
                                @error('name')
                                    <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <span style="padding-left: 5px">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail">Email</label>
                                <input required type="email" name="email" class="form-control" id="exampleInputEmail"
                                    placeholder="Enter email" value={{ old('email') }}>
                                @error('email')
                                    <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <span style="padding-left: 5px">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword">Password</label>
                                <input required type="password" name="password" class="form-control"
                                    id="exampleInputPassword" placeholder="Password" value={{ old('password') }}>
                                @error('password')
                                    <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <span style="padding-left: 5px">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputRole">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="admin">Admin</option>
                                    <option value="superadmin">Super admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="labname">Lab Name:</label>
                                <select name="labname" id="labname" class="form-control">
                                    @foreach ($labs as $dev)
                                        <option value="{{ $dev->lab_name }}">{{ $dev->lab_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
@endsection
