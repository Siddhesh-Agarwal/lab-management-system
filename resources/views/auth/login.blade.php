@extends('layouts.app')

@section('content')
    <style>
        .login-card {
            min-height: 100vh;
            background: #485563;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #29323c, #485563);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #29323c, #485563);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }

        .login-inner {
            padding-top: 100px;
        }
    </style>
    <div class="login-card">
        <div class="row justify-content-center login-inner">
            <div class="col-md-6 outer-login">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>
                    @if (Session::has('error'))
                        <div id="error-alert" class="alert alert-danger" role=alert style="text-align: center">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    @if (Session::has('logout'))
                        <div id="success-alert" class="alert alert-success" role=success style="text-align: center">
                            {{ Session::get('logout') }}
                        </div>
                    @endif
                    <div class="card-body login">
                        <form method="POST" action="{{ route('login') }}" id="form-login">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
