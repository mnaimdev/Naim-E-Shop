@extends('frontend.master')

@section('content')
    <section class="single-banner inner-section"
        style="background: url({{ asset('/frontend_assets/images/single-banner.jpg') }}) no-repeat center;">
        <div class="container">
            <h2>Product Details</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home / </a></li>
                <li><a href="" style="color: white; margin-left: 10px;">Product Details</a></li>


            </ol>
        </div>
    </section>

    <section class="inner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="details-gallery">

                        <ul class="details-preview">

                            <li><img style="height: 200px;"
                                    src="{{ asset('/uploads/product/preview') }}/{{ $products->preview }}" alt="product">
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="col-lg-6">

                    <div class="details-content">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="details-name"><a href="#">{{ $products->product_name }}</a></h3>

                            @if ($products->discount != null)
                                <h6 class="product-price"><del>
                                        TK {{ $products->price }}</del><span> TK {{ $products->after_discount }}</span>
                                </h6>
                            @else
                                <h6 class="product-price">
                                    <span> TK {{ $products->after_discount }}</span>
                                </h6>
                            @endif
                        </div>

                        <div class="details-rating"><i class="active icofont-star"></i><i class="active icofont-star"></i><i
                                class="active icofont-star"></i><i class="active icofont-star"></i><i
                                class="icofont-star"></i><a href="#">(3
                                reviews)</a>


                        </div>

                        <p class="details-desc">{{ $products->short_desp }}</p>

                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf


                            <input type="hidden" class="form-control" name="product_id" value="{{ $products->id }}">


                            {{-- colors --}}
                            <div class="prt_04 mb-2">
                                <p class="d-flex align-items-center mb-0 text-dark ft-medium">Color:</p>
                                <div class="text-left">

                                    @forelse ($available_colors as $color)
                                        <div class="form-check form-option form-check-inline mb-1">
                                            <input class="form-check-input color_id" type="radio"
                                                value="{{ $color->id }}" name="color_id" id="white{{ $color->id }}">

                                            {{ $color->color_name }}
                                            <label class="form-option-label rounded-circle"
                                                for="white{{ $color->id }}"><span
                                                    class="form-option-color rounded-circle"></span></label>
                                        </div>
                                    @empty
                                        <h5 class="text-center">No Color Available</h5>
                                    @endforelse


                                </div>
                            </div>


                            {{-- sizes --}}
                            <div class="prt_04 mb-4">
                                <p class="d-flex align-items-center mb-0 text-dark ft-medium">Size:</p>
                                <div class="text-left pb-0 pt-2" id="size_id">
                                    @forelse ($sizes as $size)
                                        <div class="form-check size-option form-option  form-check-inline mb-2">
                                            <input class="form-check-input" type="radio" name="size_id"
                                                value=" {{ $size->id }}" id="{{ $size->id }}">
                                            <label class="form-option-label"
                                                for="{{ $size->id }}">{{ $size->size_name }}</label>
                                        </div>
                                    @empty
                                        <h4 class="text-danger">No Size Available</h4>
                                    @endforelse


                                </div>
                            </div>

                            {{-- quantity --}}
                            <div class="prt_04 mb-2 d-flex">
                                <p style="margin-right: 15px;">Quantity:</p>
                                <!-- Quantity -->
                                <select class="mb-2" name="quantity">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>



                            </div>

                            @if (session('stock'))
                                <strong class="text-danger">
                                    {{ session('stock') }}
                                </strong>
                            @endif

                            @auth('customerlogin')
                                <div class="details-add-group">
                                    <button type="submit" name="btn" value="1"
                                        style="background-color: green; width: 100%; padding: 5px; border-radius: 5px; margin: 5px 0; color: white;"
                                        title="Add to Cart"> <i class="fas fa-shopping-basket"></i><span>add
                                            to cart</span>
                                    </button>
                                </div>

                                <div class="details-add-group">
                                    <button type="submit" name="btn" value="2"
                                        style="background-color: black; width: 100%; padding: 5px; border-radius: 5px; margin: 5px 0; color: white;"
                                        title="Add to Cart"> <i class="icofont-heart"></i><span>add
                                            to wishlist</span>
                                    </button>
                                </div>
                            @else
                                <div class="alert alert-danger">
                                    <h4>Please Login first, <a href="{{ route('customer.login') }}">Login</a></h4>
                                </div>
                            @endauth


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="inner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs">
                        <li><a href="#tab-desc" class="tab-link active" data-bs-toggle="tab">descriptions</a></li>
                        <li><a href="#tab-spec" class="tab-link" data-bs-toggle="tab">Specifications</a></li>
                        <li><a href="#tab-reve" class="tab-link" data-bs-toggle="tab">reviews ({{ $total_reviews }})</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-pane fade show active" id="tab-desc">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-details-frame">
                            <div class="tab-descrip">
                                <p>
                                    {!! $products->long_desp !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="tab-spec">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-details-frame">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">Product code</th>
                                        <td>SKU: 101783</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Weight</th>
                                        <td>1kg, 2kg</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Styles</th>
                                        <td>@Girly</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Properties</th>
                                        <td>Short Dress</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-reve">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-details-frame">
                            <ul class="review-list">
                                @foreach ($reviews as $review)
                                    <li class="review-item">
                                        <div class="review-media">

                                            @if ($review->rel_to_customer->photo == '')
                                                <img width="64"
                                                    src="{{ Avatar::create($review->rel_to_customer->name)->toBase64() }}" />
                                            @else
                                                <img style="border-radius: 100%; object-fit: cover; width: 50px; height: 50px;"
                                                    src="{{ asset('/uploads/customer') }}/{{ $review->rel_to_customer->photo }}"
                                                    alt="review">
                                            @endif
                                            <span>{{ $review->rel_to_customer->name }}</span>


                                            <h5 class="review-meta">
                                            </h5>
                                        </div>
                                        <ul class="review-rating d-flex">
                                            @for ($i = 0; $i < $review->star; $i++)
                                                <li class="icofont-ui-rating"></li>
                                            @endfor


                                        </ul>
                                        <p class="review-desc">
                                            {{ $review->review }}
                                        </p>

                                    </li>
                                @endforeach
                            </ul>
                            </li>

                            </ul>
                        </div>

                        {{-- give review --}}

                        @auth('customerlogin')
                            {{-- check review --}}
                            @if (App\Models\OrderProduct::where('customer_id', Auth::guard('customerlogin')->id())->where('product_id', $products->id)->exists())
                                @if (App\Models\OrderProduct::where('customer_id', Auth::guard('customerlogin')->id())->where('product_id', $products->id)->whereNull('review')->first() == true)
                                    <div class="product-details-frame">
                                        <h3 class="frame-title">Add Review</h3>
                                        <form class="review-form" action="{{ route('review.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="star-rating">
                                                        <input type="radio" name="star" id="star-1" value="1">
                                                        <label for="star-1"></label>
                                                        <input type="radio" name="star" id="star-2" value="2">
                                                        <label for="star-2"></label>
                                                        <input type="radio" name="star" id="star-3" value="3">
                                                        <label for="star-3"></label>
                                                        <input type="radio" name="star" id="star-4" value="4">
                                                        <label for="star-4"></label>
                                                        <input type="radio" name="star" id="star-5" value="5">
                                                        <label for="star-5"></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <textarea name="review" class="form-control" placeholder="Describe"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <input type="file" name="image" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input type="text" readonly
                                                            value="{{ Auth::guard('customerlogin')->user()->name }}"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input type="email" readonly
                                                            value="{{ Auth::guard('customerlogin')->user()->email }}"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <input type="hidden" name="customer_id"
                                                    value="{{ Auth::guard('customerlogin')->id() }}">
                                                <input type="hidden" name="product_id" value="{{ $products->id }}">

                                                <div class="col-lg-12">
                                                    <button type="submit" class="btn dark my-2 p-2"
                                                        style="border-color: black;">
                                                        Review
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @else
                                    <h4>You have already given a review</h4>
                                @endif
                            @else
                                <h4>Please buy a product then give review</h4>
                            @endif
                        @else
                            <h4 class="alert alert-danger my-3 p-2">Please login first, <a
                                    href="{{ route('customer.login') }}">Login</a></h4>
                        @endauth



                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="inner-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-heading">
                        <h2>related this items</h2>
                    </div>
                </div>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                @foreach ($related_products as $product)
                    <div class="col">
                        <div class="product-card" style="height: 400px;">
                            <div class="product-media">
                                <div class="product-label"><label class="label-text sale">sale</label></div><button
                                    class="product-wish wish"><i class="fas fa-heart"></i></button><a
                                    class="product-image" href="{{ route('product.details', $product->slug) }}"><img
                                        style="height: 200px;"
                                        src="{{ asset('/uploads/product/preview') }}/{{ $product->preview }}"
                                        alt="product"></a>

                            </div>

                            <div class="product-content">
                                <div class="product-rating"><i class="active icofont-star"></i><i
                                        class="active icofont-star"></i><i class="active icofont-star"></i><i
                                        class="active icofont-star"></i><i class="icofont-star"></i><a
                                        href="">(3)</a></div>
                                <h6 class="product-name">
                                    <a
                                        href="{{ route('product.details', $product->slug) }}">{{ $product->product_name }}</a>
                                </h6>

                                @if ($product->discount == null)
                                    <h6 class="product-price">
                                        <span> TK {{ $product->price }}</span>
                                    </h6>
                                @else
                                    <h6 class="product-price"><del>
                                            TK {{ $product->price }}</del><span> TK {{ $product->after_discount }}</span>
                                    </h6>
                                @endif

                                <a href="{{ route('product.details', $product->slug) }}" class="product-add"><i
                                        class="fas fa-shopping-basket"></i><span>view</span>
                                </a>

                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-btn-25"><a href="shop-4column.html" class="btn btn-outline"><i
                                class="fas fa-eye"></i><span>view all related</span></a></div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer_scripts')
    <script>
        $(".color_id").click(function() {
            var color_id = $(this).val();
            var product_id = '{{ $products->id }}';

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/getSize",
                type: "POST",
                data: {
                    "color_id": color_id,
                    "product_id": product_id,
                },
                success: function(data) {
                    $('#size_id').html(data);
                }
            });
        });
    </script>
@endsection
