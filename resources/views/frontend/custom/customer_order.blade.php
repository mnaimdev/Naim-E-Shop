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
                                <li style="border: 1px solid gray; padding: 5px;"><a style="color: red; font-weight: bold"
                                        href="{{ route('customer.order') }}"><i class="lni lni-shopping-basket mr-2"></i>My
                                        Order</a></li>

                                <li style="border: 1px solid gray; padding: 5px;">
                                    <a style="color: black; font-weight: bold" href="{{ route('customer.profile') }}"><i
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

                <div class="col-12 col-md-12 col-lg-8 col-xl-8 text-center">

                    <!-- Single Order List -->
                    @foreach ($orders as $order)
                        <div class="ord_list_wrap border mb-4 mfliud">
                            <div class="ord_list_head gray d-flex align-items-center justify-content-between px-3 py-3">
                                <div class="olh_flex">
                                    <p class="m-0 p-0"><span class="text-muted">Order Number</span></p>
                                    <h6 class="mb-0 ft-medium">{{ $order->order_id }}</h6>
                                </div>

                                <div class="col-xl-3 col-lg-3 col-md-3 col-6">
                                    <p>Invoice</p>
                                    <a href="{{ route('invoice.download', $order->id) }}"
                                        style="padding: 5px; border-radius: 5px;" class="btn-primary">Download</a>
                                </div>

                                <div class="col-xl-3 col-lg-3 col-md-3 col-6">
                                    <p class="mb-1 p-0"><span class="text-muted">Status</span></p>
                                    <div class="delv_status">
                                        <span
                                            class="ft-medium small text-white bg-{{ $order->status == 4 ? 'success' : 'danger' }} rounded px-3 py-1">

                                            @php
                                                if ($order->status == 0) {
                                                    echo 'Placed';
                                                } elseif ($order->status == 1) {
                                                    echo 'Packaging';
                                                } elseif ($order->status == 2) {
                                                    echo 'Shipped';
                                                } elseif ($order->status == 3) {
                                                    echo 'Ready to Deliver';
                                                } else {
                                                    echo 'Delivered';
                                                }
                                                
                                            @endphp
                                        </span>
                                    </div>
                                </div>

                                <div class="olh_flex">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-dark">Track
                                        Order</a>
                                </div>
                            </div>
                            <div class="ord_list_body text-left">

                                <!-- First Product -->
                                @foreach (App\Models\OrderProduct::where('order_id', $order->order_id)->get() as $product)
                                    <div class="row align-items-center justify-content-center m-0 py-4 br-bottom">
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                                            <div class="cart_single d-flex align-items-start mfliud-bot">
                                                <div class="cart_selected_single_thumb">
                                                    <a href="#"><img
                                                            src="{{ asset('/uploads/product/preview') }}/{{ $product->rel_to_product->preview }}"
                                                            width="75" class="img-fluid rounded" alt=""></a>
                                                </div>
                                                <div class="cart_single_caption pl-3">
                                                    <p class="mb-0"><span
                                                            class="text-muted small">{{ $product->rel_to_product->rel_to_category->category_name }}</span>
                                                    </p>
                                                    <h4 class="product_title fs-sm ft-medium mb-1 lh-1">
                                                        {{ $product->rel_to_product->product_name }}
                                                    </h4>
                                                    <p class="mb-2"><span class="text-dark medium">Size:
                                                            {{ $product->rel_to_size->size_name }}</span>,
                                                        <span class="text-dark medium">Color:
                                                            {{ $product->rel_to_color->color_name }}</span>
                                                    </p>
                                                    <h4 class="fs-sm ft-bold mb-0 lh-1">Tk
                                                        {{ $product->rel_to_product->after_discount }} X
                                                        {{ $product->quantity }}</h4>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-lg-4 col-md-4 col-6">
                                            <p class="mb-1 p-0"><span class="text-muted">Expected date
                                                    by:</span></p>
                                            <h6 class="mb-0 ft-medium fs-sm">
                                                {{ $product->created_at->format('d-M-Y') }}
                                            </h6>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="ord_list_footer d-flex align-items-center justify-content-between br-top px-3">
                                <div class="col-xl-8 col-lg-8 col-md-8 olf_flex text-left px-0 py-2 br-right">
                                    <a href="javascript:void(0);" class="ft-medium fs-sm"><i
                                            class="ti-close mr-2"></i>Cancel Order</a>
                                </div>
                                <div
                                    class="col-xl-4 col-lg-4 col-md-4 pr-0 py-2 olf_flex d-flex align-items-center justify-content-between">

                                    <div class="olf_inner_right float-end">
                                        <h5 class="mb-0 fs-sm ft-bold">Total: TK {{ $order->total }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- End Order List -->
                </div>

            </div>
        </div>
    </section>
    <!-- ======================= Dashboard Detail End ======================== -->
@endsection
