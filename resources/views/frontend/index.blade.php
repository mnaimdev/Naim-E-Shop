@extends('frontend.master')

@section('content')
    {{-- slider --}}
    <section class="home-index-slider slider-arrow slider-dots">
        <div class="banner-part banner-1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 col-lg-6">
                        <div class="banner-content">
                            <h1>free home delivery within 24 hours now.</h1>
                            <p>Lorem ipsum dolor consectetur adipisicing elit modi consequatur eaque expedita porro
                                necessitatibus eveniet voluptatum quis pariatur Laboriosam molestiae architecto
                                excepturi</p>
                            <div class="banner-btn"><a class="btn btn-inline" href="shop-4column.html"><i
                                        class="fas fa-shopping-basket"></i><span>shop now</span></a><a
                                    class="btn btn-outline" href="offer.html"><i class="icofont-sale-discount"></i><span>get
                                        offer</span></a></div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="banner-img"><img src="{{ asset('/frontend_assets/images/home/index/01.png') }}"
                                alt="index"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-part banner-2">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 col-lg-6">
                        <div class="banner-img"><img src="{{ asset('/frontend_assets/images/home/index/02.png') }}"
                                alt="index"></div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="banner-content">
                            <h1>free home delivery within 24 hours now.</h1>
                            <p>Lorem ipsum dolor consectetur adipisicing elit modi consequatur eaque expedita porro
                                necessitatibus eveniet voluptatum quis pariatur Laboriosam molestiae architecto
                                excepturi</p>
                            <div class="banner-btn"><a class="btn btn-inline" href="shop-4column.html"><i
                                        class="fas fa-shopping-basket"></i><span>shop now</span></a><a
                                    class="btn btn-outline" href="offer.html"><i class="icofont-sale-discount"></i><span>get
                                        offer</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- suggest --}}
    <section class="section suggest-part">
        <div class="container">
            <ul class="suggest-slider slider-arrow">
                @foreach ($categories as $category)
                    <li><a class="suggest-card" href=""><img style="height: 100px; width: 200px;"
                                src="{{ asset('/uploads/category') }}/{{ $category->cat_img }}" alt="suggest">
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- products --}}
    <section class="section recent-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Recent Products</h2>
                    </div>
                </div>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                @foreach ($products as $product)
                    <div class="col">
                        <div class="product-card" style="height: 400px;">
                            <div class="product-media">
                                <div class="product-label"><label class="label-text sale">sale</label></div><button
                                    class="product-wish wish"><i class="fas fa-heart"></i></button><a class="product-image"
                                    href="{{ route('product.details', $product->slug) }}"><img style="height: 200px;"
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

        </div>
    </section>

    {{-- promo image --}}
    <div class="section promo-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="promo-img"><a href="#"><img
                                src="{{ asset('/frontend_assets/images/promo/home/03.jpg') }}" alt="promo"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- new item --}}
    <section class="section newitem-part">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-heading">
                        <h2>collected new items</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <ul class="new-slider slider-arrow">
                        @foreach ($new_items as $item)
                            <li>
                                <div class="product-card">
                                    <div class="product-media">

                                        <a class="product-image" href="{{ route('product.details', $item->slug) }}">
                                            <img style="height: 200px"
                                                src="{{ asset('/uploads/product/preview') }}/{{ $item->preview }}"
                                                alt="product">
                                        </a>
                                    </div>

                                    <div class="product-content">
                                        <div class="product-rating">
                                            <i class="active icofont-star"></i>
                                            <i class="active icofont-star"></i>
                                            <i class="active icofont-star"></i>
                                            <i class="active icofont-star"></i>
                                            <i class="icofont-star"></i>
                                            <a href="{{ route('product.details', $item->slug) }}">(3)</a>
                                        </div>

                                        <h6 class="product-name">
                                            <a
                                                href="{{ route('product.details', $item->slug) }}">{{ $item->product_name }}</a>
                                        </h6>

                                        @if ($item->discount != null)
                                            <h6 class="product-price"><del>
                                                    TK {{ $item->price }}</del><span> TK
                                                    {{ $item->after_discount }}</span>
                                            </h6>
                                        @else
                                            <h6 class="product-price">
                                                <span> TK {{ $item->after_discount }}</span>
                                            </h6>
                                        @endif

                                        <a class="product-add" href="{{ route('product.details', $item->slug) }}"><i
                                                class="fas fa-shopping-basket"></i><span>View</span></a>

                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="section-btn-25"><a href="shop-4column.html" class="btn btn-outline"><i
                                class="fas fa-eye"></i><span>show more</span></a></div>
                </div>
            </div>
        </div>
    </section>

    {{-- promo part --}}
    <div class="section promo-part">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 px-xl-3">
                    <div class="promo-img"><a href="#"><img
                                src="{{ asset('/frontend_assets/images/promo/home/01.jpg') }}" alt="promo"></a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 px-xl-3">
                    <div class="promo-img"><a href="#"><img
                                src="{{ asset('/frontend_assets/images/promo/home/02.jpg') }}" alt="promo"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- niche part --}}
    <section class="section niche-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Browse by Top Niche</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs">
                        <li><a href="#top-order" class="tab-link active" data-bs-toggle="tab"><i
                                    class="icofont-price"></i><span>top order</span></a></li>
                        <li><a href="#top-rate" class="tab-link" data-bs-toggle="tab"><i
                                    class="icofont-star"></i><span>top rating</span></a></li>
                        <li><a href="#top-disc" class="tab-link" data-bs-toggle="tab"><i
                                    class="icofont-sale-discount"></i><span>top discount</span></a></li>
                    </ul>
                </div>
            </div>

            {{-- top order --}}
            <div class="tab-pane fade show active" id="top-order">
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                    @foreach ($top_orders as $order)
                        <li>
                            <div class="product-card">
                                <div class="product-media">



                                    <a class="product-image"
                                        href="{{ route('product.details', $order->rel_to_product->slug) }}">
                                        <img style="height: 200px"
                                            src="{{ asset('/uploads/product/preview') }}/{{ $order->rel_to_product->preview }}"
                                            alt="product">
                                    </a>
                                </div>

                                <div class="product-content">
                                    <div class="product-rating">
                                        <i class="active icofont-star"></i>
                                        <i class="active icofont-star"></i>
                                        <i class="active icofont-star"></i>
                                        <i class="active icofont-star"></i>
                                        <i class="icofont-star"></i>
                                        <a href="{{ route('product.details', $order->rel_to_product->slug) }}">(3)</a>
                                    </div>

                                    <h6 class="product-name">
                                        <a
                                            href="{{ route('product.details', $order->rel_to_product->slug) }}">{{ $order->rel_to_product->product_name }}</a>
                                    </h6>

                                    @if ($order->discount != null)
                                        <h6 class="product-price"><del>
                                                TK {{ $order->rel_to_product->price }}</del><span> TK
                                                {{ $order->rel_to_product->after_discount }}</span>
                                        </h6>
                                    @else
                                        <h6 class="product-price">
                                            <span> TK {{ $order->rel_to_product->after_discount }}</span>
                                        </h6>
                                    @endif

                                    <a class="product-add"
                                        href="{{ route('product.details', $order->rel_to_product->slug) }}"><i
                                            class="fas fa-shopping-basket"></i><span>View</span></a>

                                </div>
                            </div>
                        </li>
                    @endforeach
                </div>
            </div>

            {{-- top rate --}}
            <div class="tab-pane fade" id="top-rate">
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                    <div class="col">
                        <div class="product-card">
                            <div class="product-media">
                                <div class="product-label"><label class="label-text rate">4.8</label></div><button
                                    class="product-wish wish"><i class="fas fa-heart"></i></button><a
                                    class="product-image" href="product-video.html"><img src="images/product/11.jpg"
                                        alt="product"></a>
                                <div class="product-widget"><a title="Product Compare" href="compare.html"
                                        class="fas fa-random"></a><a title="Product Video"
                                        href="https://youtu.be/9xzcVxSBbG8" class="venobox fas fa-play"
                                        data-autoplay="true" data-vbtype="video"></a><a title="Product View"
                                        href="#" class="fas fa-eye" data-bs-toggle="modal"
                                        data-bs-target="#product-view"></a></div>
                            </div>
                            <div class="product-content">
                                <div class="product-rating"><i class="active icofont-star"></i><i
                                        class="active icofont-star"></i><i class="active icofont-star"></i><i
                                        class="active icofont-star"></i><i class="icofont-star"></i><a
                                        href="product-video.html">(3)</a></div>
                                <h6 class="product-name"><a href="product-video.html">fresh green chilis</a></h6>
                                <h6 class="product-price"><del>$34</del><span>$28<small>/piece</small></span></h6>
                                <button class="product-add" title="Add to Cart"><i
                                        class="fas fa-shopping-basket"></i><span>add</span></button>
                                <div class="product-action"><button class="action-minus" title="Quantity Minus"><i
                                            class="icofont-minus"></i></button><input class="action-input"
                                        title="Quantity Number" type="text" name="quantity" value="1"><button
                                        class="action-plus" title="Quantity Plus"><i class="icofont-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- top discount --}}
            <div class="tab-pane fade" id="top-disc">
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                    <div class="col">
                        <div class="product-card">
                            <div class="product-media">
                                <div class="product-label"><label class="label-text off">-10%</label></div><button
                                    class="product-wish wish"><i class="fas fa-heart"></i></button><a
                                    class="product-image" href="product-video.html"><img src="images/product/06.jpg"
                                        alt="product"></a>
                                <div class="product-widget"><a title="Product Compare" href="compare.html"
                                        class="fas fa-random"></a><a title="Product Video"
                                        href="https://youtu.be/9xzcVxSBbG8" class="venobox fas fa-play"
                                        data-autoplay="true" data-vbtype="video"></a><a title="Product View"
                                        href="#" class="fas fa-eye" data-bs-toggle="modal"
                                        data-bs-target="#product-view"></a></div>
                            </div>
                            <div class="product-content">
                                <div class="product-rating"><i class="active icofont-star"></i><i
                                        class="active icofont-star"></i><i class="active icofont-star"></i><i
                                        class="active icofont-star"></i><i class="icofont-star"></i><a
                                        href="product-video.html">(3)</a></div>
                                <h6 class="product-name"><a href="product-video.html">fresh green chilis</a></h6>
                                <h6 class="product-price"><del>$34</del><span>$28<small>/piece</small></span></h6>
                                <button class="product-add" title="Add to Cart"><i
                                        class="fas fa-shopping-basket"></i><span>add</span></button>
                                <div class="product-action"><button class="action-minus" title="Quantity Minus"><i
                                            class="icofont-minus"></i></button><input class="action-input"
                                        title="Quantity Number" type="text" name="quantity" value="1"><button
                                        class="action-plus" title="Quantity Plus"><i class="icofont-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-btn-25"><a href="shop-4column.html" class="btn btn-outline"><i
                                class="fas fa-eye"></i><span>show more</span></a></div>
                </div>
            </div>
        </div>
    </section>



    {{-- testimonial --}}
    <section class="section testimonial-part">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h2>client's feedback</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="testimonial-slider slider-arrow">
                        <div class="testimonial-card"><i class="fas fa-quote-left"></i>
                            <p>Lorem ipsum dolor consectetur adipisicing elit neque earum sapiente vitae obcaecati
                                magnam doloribus magni provident ipsam</p>
                            <h5>mahmud hasan</h5>
                            <ul>
                                <li class="fas fa-star"></li>
                                <li class="fas fa-star"></li>
                                <li class="fas fa-star"></li>
                                <li class="fas fa-star"></li>
                                <li class="fas fa-star"></li>
                            </ul><img src="images/avatar/01.jpg" alt="testimonial">
                        </div>
                        <div class="testimonial-card"><i class="fas fa-quote-left"></i>
                            <p>Lorem ipsum dolor consectetur adipisicing elit neque earum sapiente vitae obcaecati
                                magnam doloribus magni provident ipsam</p>
                            <h5>mahmud hasan</h5>
                            <ul>
                                <li class="fas fa-star"></li>
                                <li class="fas fa-star"></li>
                                <li class="fas fa-star"></li>
                                <li class="fas fa-star"></li>
                                <li class="fas fa-star"></li>
                            </ul><img src="images/avatar/02.jpg" alt="testimonial">
                        </div>
                        <div class="testimonial-card"><i class="fas fa-quote-left"></i>
                            <p>Lorem ipsum dolor consectetur adipisicing elit neque earum sapiente vitae obcaecati
                                magnam doloribus magni provident ipsam</p>
                            <h5>mahmud hasan</h5>
                            <ul>
                                <li class="fas fa-star"></li>
                                <li class="fas fa-star"></li>
                                <li class="fas fa-star"></li>
                                <li class="fas fa-star"></li>
                                <li class="fas fa-star"></li>
                            </ul><img src="images/avatar/03.jpg" alt="testimonial">
                        </div>
                        <div class="testimonial-card"><i class="fas fa-quote-left"></i>
                            <p>Lorem ipsum dolor consectetur adipisicing elit neque earum sapiente vitae obcaecati
                                magnam doloribus magni provident ipsam</p>
                            <h5>mahmud hasan</h5>
                            <ul>
                                <li class="fas fa-star"></li>
                                <li class="fas fa-star"></li>
                                <li class="fas fa-star"></li>
                                <li class="fas fa-star"></li>
                                <li class="fas fa-star"></li>
                            </ul><img src="images/avatar/04.jpg" alt="testimonial">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer_scripts')
    @if (session('login'))
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
                title: '{{ session('login') }}'
            })
        </script>
    @endif
@endsection
