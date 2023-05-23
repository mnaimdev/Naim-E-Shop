@extends('frontend.master')


@section('content')
    <!-- ======================= Dashboard Detail ======================== -->
    <section class="middle">
        <div class="container my-3">
            <div class="row align-items-start justify-content-between">

                <div class="col-12 col-md-12 col-lg-4 col-xl-4 text-center miliods">
                    <div class="d-block border rounded mfliud-bot">
                        <div class="dashboard_author px-2 py-5">
                            <div class="dash_auth_thumb circle p-1 border d-inline-flex mx-auto mb-2">

                                @if (Auth::guard('customerlogin')->user()->photo == null)
                                    <img width="50"
                                        src="{{ Avatar::create(Auth::guard('customerlogin')->user()->name)->toBase64() }}"
                                        alt="">
                                @else
                                    <img src="{{ asset('/uploads/customer') }}/{{ Auth::guard('customerlogin')->user()->photo }}"
                                        class="img-fluid circle" width="100" height="50" alt="" />
                                @endif


                            </div>
                            <div class="dash_caption">
                                <h4 class="fs-md ft-medium mb-0 lh-1">{{ Auth::guard('customerlogin')->user()->name }}</h4>
                                <span class="text-muted smalls">{{ Auth::guard('customerlogin')->user()->country }}</span>
                            </div>
                        </div>

                        <div class="dashboard_author">
                            <h4 class="px-3 py-2 mb-0 lh-2 gray fs-sm ft-medium text-muted text-uppercase text-left">
                                Dashboard Navigation</h4>
                            <ul class="dahs_navbar">
                                <li style="border: 1px solid gray; padding: 5px;"><a style="color: black; font-weight: bold"
                                        href="{{ route('customer.order') }}"><i class="lni lni-shopping-basket mr-2"></i>My
                                        Order</a></li>

                                <li style="border: 1px solid gray; padding: 5px;">
                                    <a style="color: red; font-weight: bold" href=""><i
                                            class="lni lni-shopping-basket mr-2"></i>Profile</a>
                                </li>

                                <li style="border: 1px solid gray; padding: 5px;"><a style="color: black; font-weight: bold"
                                        href="{{ route('wishlist') }}"><i
                                            class="lni lni-shopping-basket mr-2"></i>Wishlist</a></li>

                                <li style="border: 1px solid black; padding: 5px;"><a
                                        style="color: black; font-weight: bold" href="{{ route('customer.logout') }}"><i
                                            class="lni lni-shopping-basket mr-2"></i>Logout</a></li>

                            </ul>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-8 col-xl-8">
                    <!-- row -->
                    <div class="row align-items-center">
                        <form class="row m-0" action="{{ route('customer.profile.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            @if (session('pass'))
                                <div class="alert alert-danger">
                                    {{ session('pass') }}
                                </div>
                            @endif

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="small text-dark ft-medium">Full Name *</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ Auth::guard('customerlogin')->user()->name }}" />
                                </div>
                            </div>



                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="small text-dark ft-medium">Email Address *</label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ Auth::guard('customerlogin')->user()->email }}" />
                                </div>
                            </div>



                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="small text-dark ft-medium">Current Password *</label>
                                    <input type="password" class="form-control" name="old_pass" />
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="small text-dark ft-medium">New Password *</label>
                                    <input type="password" class="form-control" name="new_pass" />
                                </div>
                            </div>


                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="small text-dark ft-medium">Country *</label>
                                    <input type="text" class="form-control" name="country" />
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="small text-dark ft-medium">Address *</label>
                                    <input type="text" class="form-control" name="address" />
                                </div>
                            </div>



                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="small text-dark ft-medium">Photo*</label>
                                    <input type="file" class="form-control" name="photo">
                                </div>
                            </div>


                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <button type="submit"
                                        style="background-color: black; padding: 5px; border-radius: 5px; color: white; border-color: black;font-weight: bold;">Save
                                        Changes</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <!-- row -->
                </div>

            </div>
        </div>
    </section>
    <!-- ======================= Dashboard Detail End ======================== -->
@endsection
