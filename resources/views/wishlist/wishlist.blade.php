@extends('frontend.master')

@section('content')
    <!-- ======================= Dashboard Detail ======================== -->
    <section class="middle">
        <div class="container my-3">
            <div class="row justify-content-center justify-content-between">

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
                                    <a style="color: black; font-weight: bold" href="{{ route('customer.profile') }}"><i
                                            class="lni lni-shopping-basket mr-2"></i>Profile</a>
                                </li>

                                <li style="border: 1px solid gray; padding: 5px;"><a style="color: red; font-weight: bold"
                                        href="{{ route('wishlist') }}"><i
                                            class="lni lni-shopping-basket mr-2"></i>Wishlist</a></li>

                                <li style="border: 1px solid black; padding: 5px;"><a
                                        style="color: black; font-weight: bold" href="{{ route('customer.logout') }}"><i
                                            class="lni lni-shopping-basket mr-2"></i>Logout</a></li>

                            </ul>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-8 col-xl-8 text-center">
                    <!-- row -->
                    <div class="row align-items-center">

                        <!-- Single -->
                        @forelse ($wishlists as $wishlist)
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                <div class="product_grid card b-0">


                                    <div class="card-body p-0">
                                        <div class="shop_thumb position-relative">
                                            <a class="card-img-top d-block overflow-hidden"
                                                href="{{ route('product.details', $wishlist->rel_to_product->slug) }}"><img
                                                    class="card-img-top"
                                                    src="{{ asset('/uploads/product/preview') }}/{{ $wishlist->rel_to_product->preview }}"
                                                    alt="..."></a>
                                            <div
                                                class="product-hover-overlay bg-dark d-flex align-items-center justify-content-center">
                                                <div class="edlio"><a href="{{ route('wishlist.remove', $wishlist->id) }}"
                                                        data-toggle="modal" data-target="#quickview"
                                                        class="text-white fs-sm ft-medium"><i
                                                            class="fas fa-eye mr-1"></i>Remove</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="card-footers b-0 pt-3 px-2 bg-white d-flex align-items-start justify-content-center">
                                        <div class="text-left">
                                            <div class="text-center">
                                                <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a
                                                        href="{{ route('product.details', $wishlist->rel_to_product->slug) }}">{{ $wishlist->rel_to_product->product_name }}</a>
                                                </h5>
                                                <div class="elis_rty"><span class="ft-bold fs-md text-dark">TK
                                                        {{ $wishlist->rel_to_product->after_discount }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <div class="alert alert-danger my-3">You haven't added any wishlist</div>
                            <a href="{{ route('index') }}"
                                style="background-color: black; color: white; padding: 5px; border-radius: 5px; border-color: black; width: 100px;">Track
                                order</a>
                        @endforelse

                    </div>
                    <!-- row -->
                </div>

            </div>
        </div>
    </section>
    <!-- ======================= Dashboard Detail End ======================== -->
@endsection
