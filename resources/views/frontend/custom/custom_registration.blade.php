@extends('frontend.master')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 m-auto">
            <div class="card">
                <div class="card-header bg-dark text-center">
                    <h3 class="text-white">Register</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf

                        @if (session('notif'))
                            <div class="alert alert-success my-2 p-2">
                                {{ session('notif') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label>Fullname*</label>
                            <input type="text" name="name" class="form-control">
                            @error('name')
                                <strong class="text-danger">
                                    {{ $message }}
                                </strong>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" name="email" class="form-control">
                            @error('email')
                                <strong class="text-danger">
                                    {{ $message }}
                                </strong>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Password *</label>
                            <input type="password" name="password" class="form-control">
                            @error('password')
                                <strong class="text-danger">
                                    {{ $message }}
                                </strong>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Confirm Password *</label>
                            <input type="password" name="password_confirmation" class="form-control">

                            @if (session('match'))
                                <strong class="text-danger">
                                    {{ session('match') }}
                                </strong>
                            @endif

                            @error('password_confirmation')
                                <strong class="text-danger">
                                    {{ $message }}
                                </strong>
                            @enderror
                        </div>


                        <div class="form-group d-flex justify-content-between">
                            <button class="btn btn-dark" style="border-color: black;"
                                type="submit
                            ">Register</button>
                            <span class="float-right">Already Registred? <a class="text-primary"
                                    href="{{ route('customer.login') }}">Sign In</a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
    @if (session('register'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('register') }}'
            })
        </script>
    @endif
@endsection
