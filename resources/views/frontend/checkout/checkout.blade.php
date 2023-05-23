@extends('frontend.master')

@section('content')
    <!-- ======================= Product Detail ======================== -->
    <section class="middle">
        <div class="container">

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="text-center d-block mb-5">
                        <h2 class="my-2">Checkout</h2>

                    </div>
                </div>
            </div>

            <div class="row justify-content-between">
                <div class="col-12 col-lg-7 col-md-12">
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf

                        <h5 class="mb-4 ft-medium">Billing Details</h5>
                        <div class="row mb-2">

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">Full Name *</label>
                                    <input type="text" name="name"
                                        value="{{ Auth::guard('customerlogin')->user()->name }}" class="form-control"
                                        placeholder="First Name" />
                                </div>
                            </div>


                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">Email *</label>
                                    <input type="email" value="{{ Auth::guard('customerlogin')->user()->email }}"
                                        name="email" class="form-control" placeholder="Email" />
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">Company</label>
                                    <input type="text" name="company" class="form-control"
                                        placeholder="Company Name (optional)" />
                                </div>
                            </div>


                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="Address 2" />
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">Country *</label>
                                    <select name="country_id" id="country_id" class="form-control country_id">
                                        <option>-- Select Country --</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">City *</label>
                                    <select name="city_id" id="city_id" class="form-control">
                                        <option>-- Select City --</option>
                                    </select>
                                </div>
                            </div>



                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">ZIP / Postcode *</label>
                                    <input type="number" name="zip_code" class="form-control"
                                        placeholder="Zip / Postcode" />
                                </div>
                            </div>

                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">Phone Number *</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone Number" />
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">Additional Information</label>
                                    <textarea name="notes" class="form-control ht-50"></textarea>
                                </div>
                            </div>

                        </div>


                </div>

                <!-- Sidebar -->
                <div class="col-12 col-lg-4 col-md-12">
                    <div class="d-block mb-3">
                        <h5 class="mb-4">Order Items: {{ $carts->count() }}</h5>
                        <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">


                            @foreach ($carts as $cart)
                                <li class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <!-- Image -->
                                            <a href="product.html">
                                                <img src="{{ asset('/uploads/product/preview') }}/{{ $cart->rel_to_product->preview }}"
                                                    alt="..." class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="col d-flex align-items-center">
                                            <div class="cart_single_caption pl-2">
                                                <h4 class="product_title fs-md ft-medium mb-1 lh-1">
                                                    {{ $cart->rel_to_product->product_name }}
                                                </h4>
                                                <p class="mb-1 lh-1">

                                                    <input
                                                        value="{{ $cart->rel_to_size->id }}
                                                    "
                                                        name="size_id" type="radio" class="form-check-input">

                                                    Size:
                                                    {{ $cart->size_id == null ? 'N/A' : $cart->rel_to_size->size_name }}


                                                </p>
                                                <p class="mb-3 lh-1">

                                                    <input class="form-check-input" type="radio" name="color_id"
                                                        value="{{ $cart->rel_to_color->id }}">

                                                    Color:
                                                    {{ $cart->color_id == null ? 'N/A' : $cart->rel_to_color->color_name }}


                                                </p>

                                                <h4>
                                                    <input type="radio" name="quantity" value=""
                                                        class="form-check-input">
                                                    TK {{ $cart->rel_to_product->after_discount }} x {{ $cart->quantity }}
                                                </h4>

                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>


                    <!-- Delivery Location -->
                    <h5 class="mb-4 ft-medium">Delivery Location</h5>
                    <div class="mb-4">

                        <div class="form-check">
                            <input value="60" class="form-check-input charge" type="radio" name="charge"
                                id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Inside City
                            </label>
                        </div>


                        <div class="form-check">
                            <input value="120" class="form-check-input charge" type="radio" name="charge"
                                id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Outside City
                            </label>
                        </div>
                    </div>


                    <!-- Payments -->
                    <h5 class="mb-4 ft-medium">Payments</h5>
                    <div class="mb-4">

                        <div class="form-check">
                            <input value="1" class="form-check-input" type="radio" name="payment_method"
                                id="flexRadioDefault3">
                            <label class="form-check-label" for="flexRadioDefault3">
                                Cash On Delivery
                            </label>
                        </div>

                        <div class="form-check">
                            <input value="2" class="form-check-input" type="radio" name="payment_method"
                                id="flexRadioDefault4">
                            <label class="form-check-label" for="flexRadioDefault4">
                                Pay With SSLCommerz
                            </label>
                        </div>

                        <div class="form-check">
                            <input value="3" class="form-check-input" type="radio" name="payment_method"
                                id="flexRadioDefault5">
                            <label class="form-check-label" for="flexRadioDefault5">
                                Pay With Stripe
                            </label>
                        </div>

                    </div>


                    <div class="card mb-4 gray">
                        <div class="card-body">
                            <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                                <li class="list-group-item d-flex text-dark fs-sm ft-regular">

                                    <span>Subtotal: </span>
                                    <span class="ml-auto text-dark ft-medium sub_total">
                                        {{ session('sub_total') }}
                                    </span>
                                </li>

                                <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                    <span>Charge: </span> <span class="ml-auto text-dark ft-medium" id="charge">
                                        0</span>
                                </li>

                                <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                    <span>Discount: </span>
                                    <span class="ml-auto text-dark ft-medium" id="discount">
                                        {{ session('discount') }}
                                    </span>
                                </li>

                                <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                    <span>Total: </span> <span class="ml-auto text-dark ft-medium"
                                        id="total">{{ session('total') }}</span>
                                </li>

                                <li class="list-group-item fs-sm text-center">
                                    Charge calculated at Checkout *
                                </li>
                            </ul>
                        </div>
                    </div>

                    <input type="hidden" name="customer_id" value="{{ Auth::guard('customerlogin')->id() }}" />
                    <input type="hidden" name="sub_total" value="{{ session('sub_total') }}">
                    <input type="hidden" name="discount" value="{{ session('discount') }}">

                    <button type="submit"
                        style="background-color: black; padding: 5px; border-radius: 5px; color: white; border-color: black; margin: 10px 0px;">Place
                        Your Order</button>
                </div>

                </form>

            </div>

        </div>
    </section>
    <!-- ======================= Product Detail End ======================== -->
@endsection

@section('footer_scripts')
    <script>
        $('#country_id').change(function() {
            var country_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/getCity',
                type: 'POST',
                data: {
                    country_id: country_id
                },
                success: function(data) {
                    $('#city_id').html(data);
                }
            });

        });
    </script>

    <script>
        $(".charge").click(function() {
            var charge = $(this).val();
            var sub_total = $(".sub_total").html();
            var discount = $("#discount").html();

            var total = Number(sub_total) + Number(charge) - Number(discount);

            $("#total").html(total);
            $("#charge").html(charge);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#country_id').select2();
            $('#city_id').select2();
        });
    </script>
@endsection
