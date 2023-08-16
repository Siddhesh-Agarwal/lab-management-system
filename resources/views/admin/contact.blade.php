@extends('admin.dashboard')

@section('content')
    <section class="content">

        <div class="container">
            <div class="row team">

                <div class="col-md-4 team-member">
                    <img src="{{ asset('dist/img/photo1.png') }}" width="200px">
                    <h3>Siddhesh Agarwal</h3>
                    <p class="position">Legend</p>
                    <p class="bio">sample@gmail.com</p>
                </div>
                <div class="col-md-4 team-member">
                    <img src="{{ asset('dist/img/photo1.png') }}" width="200px">
                    <h3>Shree Varshan</h3>
                    <p class="position">Padips</p>
                    <p class="bio">sample@gmail.com</p>
                </div>
                <div class="col-md-4 team-member">
                    <img src="{{ asset('dist/img/photo1.png') }}" width="200px">
                    <h3>Sundarakrishnan</h3>
                    <p class="position">SundarKi</p>
                    <p class="bio">sample@gmail.com</p>
                </div>
                <div class="col-md-4 team-member">
                    <img src="{{ asset('dist/img/photo1.png') }}" width="200px">
                    <h3>Sanjeevi</h3>
                    <p class="position">Dopes</p>
                    <p class="bio">sample@gmail.com</p>
                </div>

            </div>
        </div>
    </section>
@endsection
