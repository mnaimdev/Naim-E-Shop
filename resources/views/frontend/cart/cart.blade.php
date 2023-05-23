@extends('frontend.master')

@section('content')
    <div class="container my-5">

        <div class="row">
            <div class="col-lg-8">
                <div class="d-block mb-3">
                    <h5 class="mb-4">Order Item: {{ $carts->count() }}</h5>
                    <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">
                        <form action="{{ route('cart.update') }}" method="POST">

                            @csrf

                            @php
                                $sub_total = 0;
                            @endphp

                            @foreach ($carts as $cart)
                                <li class="list-group-item">
                                    <div class="row align-items-center d-flex justify-content-between">
                                        <div class="col-3">
                                            <!-- Image -->
                                            <a href="product.html">
                                                <img src="{{ asset('/uploads/product/preview') }}/{{ $cart->rel_to_product->preview }}"
                                                    alt="..." class="img-fluid"></a>
                                        </div>

                                        <div class="col d-flex align-items-center">
                                            <div class="cart_single_caption pl-2">
                                                <h4 class="product_title fs-md ft-medium mb-1 lh-1">
                                                    {{ $cart->rel_to_product->product_name }}
                                                </h4>

                                                <h4 class="float-end" style="margin-left: 300px;">
                                                    <a href="{{ route('cart.clear.item', $cart->id) }}">X</a>
                                                </h4>

                                                <p class="mb-1 lh-1"><span class="text-dark">Size:
                                                        {{ $cart->rel_to_size->size_name }}
                                                    </span>
                                                </p>

                                                <p class="mb-3 lh-1"><span class="text-dark">Color:
                                                        {{ $cart->rel_to_color->color_name }}
                                                    </span>
                                                </p>


                                                <select class="mb-2 custom-select" name="quantity[{{ $cart->id }}]">
                                                    <option value="1" {{ $cart->quantity == 1 ? 'selected' : '' }}>1
                                                    </option>
                                                    <option value="2" {{ $cart->quantity == 2 ? 'selected' : '' }}>2
                                                    </option>
                                                    <option value="3" {{ $cart->quantity == 3 ? 'selected' : '' }}>3
                                                    </option>
                                                    <option value="4" {{ $cart->quantity == 4 ? 'selected' : '' }}>4
                                                    </option>
                                                    <option value="5" {{ $cart->quantity == 5 ? 'selected' : '' }}>5
                                                    </option>
                                                </select>

                                                @if (session('stock'))
                                                    <strong class="text-danger">
                                                        {{ session('stock') }}
                                                    </strong>
                                                @endif

                                                @php
                                                    $sub_total += $cart->rel_to_product->after_discount * $cart->quantity;
                                                @endphp

                                            </div>
                                        </div>
                                        <div class="fls_last"><a href="" class="close_slide gray"><i
                                                    class="ti-close"></i></a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                    </ul>


                    <div class="d-flex justify-content-between">
                        <div class="m-auto ">
                            <button type="submit"
                                style="background-color: black; padding: 5px; color: white; border-radius: 5px; border-color: black;">Update
                                Cart</button>
                        </div>

                    </div>
                    </form>
                </div>
            </div>

            @if ($type == 1)
                @php
                    $discount = ($sub_total * $discount) / 100;
                    $total = $sub_total - $discount;
                @endphp
            @else
                @php
                    
                    $discount = $discount;
                    $total = $sub_total - $discount;
                @endphp
            @endif


            @php
                session([
                    'sub_total' => $sub_total,
                    'discount' => $discount,
                    'total' => $total,
                ]);
            @endphp



            <div class="col-lg-4 ml-3 p-2" style="background-color: rgb(235, 226, 226)">
                <div class="card mt-5">
                    <div class="card-body">
                        <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                            <li class="list-group-item d-flex text-dark fs-sm ft-regular">

                                <span>Subtotal: </span> <span class="ml-auto text-dark ft-medium">{{ $sub_total }}
                                    TK</span>
                            </li>

                            <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                <span>Discount: </span> <span class="ml-auto text-dark ft-medium">{{ $discount }}
                                    Tk</span>
                            </li>

                            <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                <span>Total: </span> <span class="ml-auto text-dark ft-medium">TK {{ $total }}
                                    TK</span>
                            </li>


                        </ul>
                    </div>
                </div>

                <!-- Coupon Code -->
                <form action="{{ route('cart') }}" method="GET">
                    @csrf

                    <div class="row mt-5">
                        <div class="col-lg-8">
                            <input type="text" value="{{ @$_GET['coupon_code'] }}" name="coupon_code"
                                class="form-control mx-2 my-2" placeholder="Coupon Code">

                        </div>
                        <div class="col-lg-4">
                            <button class="btn-dark w-100 mr-2 my-2 p-2">Apply</button>
                        </div>
                    </div>

                </form>

                <a href="{{ route('checkout') }}" class="p-2 mx-2 my-2 btn-dark">Checkout</a>
            </div>
        </div>

    </div>
@endsection
