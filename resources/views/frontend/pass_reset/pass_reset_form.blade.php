@extends('frontend.master')

@section('content')
    <div class="container" style="margin-top: 100px; margin-bottom: 100px;">
        <div class="col-lg-8 m-auto col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h3 class="mt-3 text-white">
                        Password Reset
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('pass.reset.complete') }}" method="POST">
                        @csrf

                        @if (session('not_match'))
                            <div class="alert alert-danger">
                                {{ session('not_match') }}
                            </div>
                        @endif

                        <div class="form-group mb-3">
                            <input type="password" class="form-control" name="password" placeholder="New Password *">
                            <input type="hidden" name="token" value="{{ $token }}">
                        </div>

                        <div class="form-group mb-3">
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Confirm Password *">
                        </div>

                        <div class="form-group mb-3">
                            <button class="btn btn-dark" type="submit">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
