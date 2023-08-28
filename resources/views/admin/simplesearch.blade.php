@extends('admin.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid" style="margin-top:100px;">
            <h2 class="text-center display-4">Search</h2>
            <!-- Search Bars Row -->

            <div class="row">
                <div class="col-md-4">
                    <form action="{{ route('admin.searchSerial') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control form-control-lg" name="search_term"
                                placeholder="Enter Serial Number">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-lg btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <br><br>
                </div>
                <div class="col-md-4">
                    <form action="{{ route('admin.searchDevice') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control form-control-lg" name="search_termd"
                                placeholder="Enter Device Name">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-lg btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <br><br>
                </div>
                <div class="col-md-4">
                    <form action="{{ route('admin.searchSystem') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control form-control-lg" name="search_terms"
                                placeholder="Enter System Number">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-lg btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <br><br>
                </div>
            </div>
            <div class="row">
                @if (request()->has('search_term'))
                    <div class="col-md-12 offset-md-2">
                        @if (isset($results) && count($results) > 0)
                            <h3>Search Results: {{ $results->sum('count') }}</h3>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Device</th>
                                        <th>Serial</th>
                                        <th>System</th>
                                        <th>Count</th>
                                        <th>Service Description</th>
                                        <th>Lab name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $key => $dev)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $dev->device_name }}</td>
                                            <td>{{ $dev->serial_number }}</td>
                                            <td>{{ $dev->system_model_number }}</td>
                                            <td>{{ $dev->count }}</td>
                                            <td>{{ $dev->desc }}</td>
                                            <td>{{ $dev->lab_name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No results found.</p>
                        @endif
                    </div>
                @endif

            </div>
            <div class="row">
                @if (request()->has('search_termd'))
                    <div class="col-md-12">
                        @if (isset($resultd) && count($resultd) > 0)
                            <h3>Total {{ $resultd[0]->device_name }} : {{ $resultd->sum('count') }}</h3>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Device</th>
                                        <th>Serial</th>
                                        <th>System</th>
                                        <th>Count</th>
                                        <th>Service Description</th>
                                        <th>Lab name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resultd as $key => $dev)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $dev->device_name }}</td>
                                            <td>{{ $dev->serial_number }}</td>
                                            <td>{{ $dev->system_model_number }}</td>
                                            <td>{{ $dev->count }}</td>
                                            <td>{{ $dev->desc }}</td>
                                            <td>{{ $dev->lab_name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No results found</p>
                        @endif
                    </div>
                @endif
            </div>
            <div class="row">
                @if (request()->has('search_terms'))
                    <div class="col-md-12 offset-md-2">
                        @if (isset($result) && count($result) > 0)
                            <h3>Search Results:</h3>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Device</th>
                                        <th>System</th>
                                        <th>Service Description</th>
                                        <th>Lab name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($result as $key => $dev)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $dev->device_name }}</td>
                                            <td>{{ $dev->system_number }}</td>
                                            <td>{{ $dev->desc }}</td>
                                            <td>{{ $dev->lab_name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No results found.</p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
