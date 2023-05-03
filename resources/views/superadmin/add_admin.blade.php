@extends('superadmin.dashboard')

@section('content')
    @if (Session::has('notification'))
        <script>
            // const Toast = Swal.mixin({
            //     toast: true,
            //     position: 'top-right',
            //     iconColor: 'white',
            //     customClass: {
            //         popup: 'colored-toast'
            //     },
            //     showConfirmButton: false,
            //     timer: 1500,
            //     timerProgressBar: true
            // })
            // await Toast.fire({
            //     icon: 'success',
            //     title: 'Success'
            // })
            toastr.success('{{ Session::get('notification') }}');
        </script>
    @endif
    <div class="card card-primary" style="margin:20px">
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
                    <input type="text" name="name" class="form-control" placeholder="Enter name" value={{ old('name') }}>
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
                    <input type="password" name="password" class="form-control" id="exampleInputPassword"
                        placeholder="Password" value={{ old('password') }}>
                    @error('password')
                        <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span style="padding-left: 5px">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputRole">Role</label>
                    <input type="text" class="form-control" id="exampleInputRole" placeholder="Admin" disabled>
                </div>
                <div class="form-group">
                    <label for="exampleInputLabName">Lab Name</label>
                    <input type="text" name="labname" class="form-control" id="exampleInputLabName"
                        placeholder="Enter a Lab name" value={{ old('labname') }}>
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
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection
