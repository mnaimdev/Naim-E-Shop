@extends('frontend.master')


@section('content')
    <div class="container mt-5 mb-5">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 m-auto">
            <div class="card">
                <div class="card-header text-center bg-dark">
                    <h3 class="text-white">
                        Sign In
                    </h3>

                </div>
                <div class="card-body">
                    <form action="{{ route('login.store') }}" method="POST">
                        @csrf

                        @if (session('verify_mail'))
                            <div class="alert alert-success my-2 p-2">
                                {{ session('verify_mail') }}
                            </div>
                        @endif

                        @if (session('verify'))
                            <div class="alert alert-success my-2 p-2">
                                {{ session('verify') }}
                            </div>
                        @endif

                        @if (session('match'))
                            <div class="alert alert-danger">
                                {{ session('match') }}
                            </div>
                        @endif

                        @if (session('reset'))
                            <div class="alert alert-success">
                                {{ session('match') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Password *</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="flex-1">
                                    <span>Don't have any account? <a class="text-primary"
                                            href="{{ route('customer.register') }}">Register</a></span>
                                </div>
                                <div class="eltio_k2">
                                    <a href="{{ route('pass.reset') }}">Forgot Password?</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-dark form-control"
                                style="border-color: black; background-color: rgb(71, 255, 117)">Login</button>
                        </div>

                        <div class="form-group">
                            <a href="{{ route('github.redirect') }}" class="btn btn-info form-control"
                                style="border-color: black; background-color: rgb(49, 191, 220);"><img width="30"
                                    src="{{ asset('/github.png') }}" alt=""></a>
                        </div>

                        <div class="form-group">
                            <a href="{{ route('google.redirect') }}" class="btn btn-primary form-control"
                                style="border-color: black; background-color: rgb(179, 214, 245)"><img width="30"
                                    src="{{ asset('/google.png') }}" alt=""></a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
