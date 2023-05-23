@extends('frontend.master')

@section('content')
    <div class="container" style="margin-top: 100px; margin-bottom: 100px;">
        <div class="col-lg-8 m-auto col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h3 class="mt-3 text-white">
                        Password Reset Request
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('pass.reset.req') }}" method="POST">
                        @csrf

                        @if (session('notif'))
                            <div class="alert alert-success my-3">
                                {{ session('notif') }}
                            </div>
                        @endif

                        @if (session('reg'))
                            <div class="alert alert-danger my-3">
                                {{ session('reg') }}
                            </div>
                        @endif

                        <div class="form-group mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email *">
                        </div>

                        <div class="form-group mb-3">
                            <button class="btn btn-dark" type="submit">
                                Send Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
