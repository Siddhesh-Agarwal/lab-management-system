@extends('superadmin.dashboard')

@section('content')
    @if (session('success '))
        <script>
            toastr.success('{{ Session::get('success') }}');
        </script>
    @endif

    @if (session('error'))
        <script>
            toastr.error('{{ Session::get('notification') }}');
        </script>
    @endif
    
    @if ($details->count() == 0)
        <h1 style="text-align: center">
            <td colspan="3" class="text-center">No Admins Found</td>
        </h1>
    @else
        <!-- Main content -->
        <section class="content" style="margin: 20px">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Admin Details</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 10%">
                                    S.No
                                </th>
                                <th style="width: 30%">
                                    Admin Name
                                </th>
                                <th style="width: 30%">
                                    Lab Name
                                </th>
                                <th style="width: 70%">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $key => $data)
                                <tr>
                                    <td>
                                        {{ $key + 1 }}
                                    </td>
                                    <td>
                                        <a>
                                            {{ $data->name }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $data->labname }}
                                    </td>
                                    <td class="project-actions" style="display: flex;">
                                        <a class="btn btn-info btn-sm" href={{ url('superadmin/edit/' . $data->id) }}
                                            style="margin-right:5px">
                                            <i class="fas fa-pencil-alt fa-lg">
                                            </i>
                                        </a>
                                        <form action={{ url('superadmin/' . $data->id) }} method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" href="#">
                                                <i class="fas fa-trash fa-lg">
                                                </i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    @endif
@endsection
