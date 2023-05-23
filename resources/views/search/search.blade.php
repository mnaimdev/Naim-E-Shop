    @extends('frontend.master')

    @section('content')
        <section class="inner-section single-banner">
            <div class="container">
                <h2>Shop 4 Column</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Search</a></li>
                </ol>
            </div>
        </section>

        <section class="inner-section shop-part">
            <div class="container">
                <div class="row content-reverse">
                    <div class="col-lg-3">
                        {{-- price --}}
                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by Price</h6>
                            <div class="shop-widget-group">
                                <input type="text" id="min" placeholder="Min - 00">
                                <input type="text" id="max" placeholder="Max - 5k">
                            </div>
                        </div>

                        {{-- category --}}
                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by Category</h6>
                            <div>

                                <ul class="shop-widget-list">
                                    @foreach ($categories as $category)
                                        <li>
                                            <div class="shop-widget-content">
                                                <input {{ $category->id == @$_GET['category_id'] ? 'checked' : '' }}
                                                    value="{{ $category->id }}" class="category_id" name="category"
                                                    type="radio" id="brand1">
                                                {{ $category->category_name }}
                                            </div>

                                        </li>
                                    @endforeach

                                </ul>

                            </div>
                        </div>

                        {{-- brand --}}
                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by Brand</h6>
                            <div>

                                <ul class="shop-widget-list">
                                    @foreach ($brands as $brand)
                                        <li>
                                            <div class="shop-widget-content">
                                                <input {{ $brand->id == @$_GET['brand_id'] ? 'checked' : '' }}
                                                    type="radio" name="brand_id" class="brand_id"
                                                    value="{{ $brand->id }}">
                                                {{ $brand->brand_name }}
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>

                        {{-- color --}}
                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by Color</h6>
                            <div>

                                <ul class="shop-widget-list">
                                    @foreach ($colors as $color)
                                        <input {{ $color->id == @$_GET['color_id'] ? 'checked' : '' }} type="radio"
                                            name="color_id" class="color_id" value="{{ $color->id }}">
                                        {{ $color->color_name }}
                                    @endforeach
                                </ul>

                            </div>
                        </div>

                        {{-- size --}}
                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by Size</h6>
                            <div>

                                <ul class="shop-widget-list">
                                    @foreach ($sizes as $size)
                                        <input {{ $size->id == @$_GET['size_id'] ? 'checked' : '' }} type="radio"
                                            name="size_id" class="size_id" value="{{ $size->id }}">
                                        {{ $size->size_name }}
                                    @endforeach
                                </ul>

                            </div>
                        </div>

                    </div>


                    <div class="col-lg-9">
                        <div class="top-filter">

                            <div class="filter-short"><label class="filter-label">Short by :</label>
                                <select class="sort">
                                    <option>-- Sort by --</option>
                                    <option {{ @$_GET['sort'] == 1 ? 'selected' : '' }} value="1">sort by letter: A -
                                        Z
                                    </option>
                                    <option {{ @$_GET['sort'] == 2 ? 'selected' : '' }} value="2">sort by letter: Z -
                                        A
                                    </option>
                                    <option {{ @$_GET['sort'] == 3 ? 'selected' : '' }} value="3">sort by price: Low
                                    </option>
                                    <option {{ @$_GET['sort'] == 4 ? 'selected' : '' }} value="4">sort by price: High
                                    </option>
                                </select>
                            </div>
                            <div class="filter-action"><a href="shop-3column.html" title="Three Column"><i
                                        class="fas fa-th"></i></a><a href="shop-2column.html" title="Two Column"><i
                                        class="fas fa-th-large"></i></a><a href="shop-1column.html" title="One Column"><i
                                        class="fas fa-th-list"></i></a></div>
                        </div>

                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4">
                            @forelse ($searched_products as $product)
                                <div class="col">

                                    <div class="product-card">
                                        <div class="product-media">
                                            <a class="product-image" href="{{ route('product.details', $product->slug) }}">
                                                <img style="height: 100px;"
                                                    src="{{ asset('/uploads/product/preview') }}/{{ $product->preview }}"
                                                    alt="product">
                                            </a>
                                        </div>
                                    </div>

                                    <div class="product-content">
                                        <div class="product-rating">
                                            <i class="active icofont-star"></i><i class="active icofont-star"></i><i
                                                class="active icofont-star"></i><i class="active icofont-star"></i><i
                                                class="icofont-star"></i><a href="product-video.html">(3)</a>

                                        </div>

                                        <h6 class="product-name"><a href="{{ route('product.details', $product->slug) }}">
                                                {{ $product->product_name }}
                                            </a>

                                        </h6>

                                        @if ($product->discount == '')
                                            <h6 class="product-price">
                                                <span>{{ $product->price }}</span>
                                            </h6>
                                        @else
                                            <h6 class="product-price">
                                                <del>{{ $product->price }} TK</del>
                                                <span>{{ $product->after_discount }} TK</span>
                                            </h6>
                                        @endif


                                        <a href="{{ route('product.details', $product->slug) }}" class="product-add"
                                            title="Add to Cart">
                                            <i class="fas fa-shopping-basket"></i><span>View</span>
                                        </a>
                                    </div>
                                </div>


                            @empty
                                <h4>No Product Match</h4>
                            @endforelse
                        </div>


                        <div class="bottom-paginate mt-5 m-auto">
                            <p class="page-info">Showing {{ $searched_products->count() }} of
                                {{ App\Models\Product::count() }} Results</p>
                            {{-- <ul class="pagination">
                                        {{ $searched_products->links() }}
                                    </ul> --}}
                        </div>


                    </div>






                </div>


            </div>

        </section>
    @endsection
