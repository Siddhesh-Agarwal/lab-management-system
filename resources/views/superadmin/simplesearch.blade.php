@extends('superadmin.dashboard')

@section('content')
    <section class="content" style="margin-top:100px;">
        <div class="container">
            <div class="container-fluid">
                <h2 class="text-center display-4">Search</h2>
                <!-- Search Bars Row -->
                <div class="row">
                    <div class="col-md-4">
                        <form action="{{ route('superadmin.searchSerial') }}" method="POST">
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
                        <form action="{{ route('superadmin.searchDevice') }}" method="POST">
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
                        <form action="{{ route('superadmin.searchSystem') }}" method="POST">
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
                        <div class="col-md-8 offset-md-2">
                            @if (isset($results) && count($results) > 0)
                                <h3>Search Results: {{ $results->sum('count') }}</h3>
                                <table class="table">
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
                        <div class="col-md-8 offset-md-2">
                            @if (isset($resultd) && count($resultd) > 0)
                                <h3>Search Results: {{ $resultd->sum('count') }}</h3>
                                <table class="table">
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
                        <div class="col-md-8 offset-md-2">
                            @if (isset($result) && count($result) > 0)
                                <h3>Search Results:</h3>
                                <table class="table">
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
        </div>
    </section>
@endsection
