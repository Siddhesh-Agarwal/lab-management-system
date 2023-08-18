@extends('superadmin.dashboard')

@section('content')
    <div class="card card-primary" style="margin: 20px">
        <div class="card-header">
            <h3 class="card-title">Edit Admin</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action={{ route('superadmin.update.admin', $user->id) }} method="POST" enctype="multipart/form-data">
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
                    <input type="password" name="password" class="form-control" id="exampleInputPassword"
                        value="">
                    @error('password')
                        <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span style="padding-left: 5px">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputRole">Role</label>
                    <input type="text" class="form-control" name="role" id="exampleInputRole"
                        value={{ $user->role }}>
                    @error('role')
                        <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span style="padding-left: 5px">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputLabName">Lab Name</label>
                    <input type="text" name="labname" class="form-control" id="exampleInputLabName"
                        value={{ urldecode($user->labname) }}>
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
    <!-- /.card -->
@endsection
