<x-guest-layout layout="woocommerce home-2">
    <div id="main-content">
        <div class="content-area">
            <div class="site-content sidebar-right layout-1">
                <div class="container">
                    <div class="row">
                        <main class="site-main col-lg-9">
                            <div class="wrap-main-content">
                                <div class="product">
                                    <!-- block Product-detail -->
                                    <div class="bl-product-detail">
                                        <div class="media-product">
                                            <div class="slide-images js-call-slick-col" data-numofshow="1"
                                                data-numofscroll="1" data-loopslide="1" data-autoscroll="0"
                                                data-speedauto="6000"
                                                data-responsive="[1, 1], [1, 1], [1, 1], [1, 1], [1, 1]" data-fade="1"
                                                data-customdot="1">

                                                <div class="slide-slick">
                                                    <div class="item-slick" data-thumb="{{ $movie->thumbnail->url }}">
                                                        <div class="item-img">
                                                            <img src="{{ $movie->thumbnail->url }}" alt="IMG">
                                                        </div>
                                                    </div>

                                                    <div class="item-slick"
                                                        data-thumb="{{ asset('assets/images/product-thumb-02.jpg') }}">
                                                        <div class="item-img">
                                                            <img src="{{ asset('assets/images/single-product-02.jpg') }}"
                                                                alt="IMG">
                                                        </div>
                                                    </div>

                                                    <div class="item-slick"
                                                        data-thumb="{{ asset('assets/images/product-thumb-03.jpg') }}">
                                                        <div class="item-img">
                                                            <img src="{{ asset('assets/images/single-product-03.jpg') }}"
                                                                alt="IMG">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="wrap-dot-slick"></div>
                                            </div>
                                        </div>

                                        <div class="text-product">
                                            <h4 class="name-product">
                                                {{ $movie->title }}
                                            </h4>

                                            <div class="star-product">
                                                <span class="iconstars">
                                                    @php
                                                        // Calculate filled stars as a float (out of 5)
                                                        $rate = $movie->rating / 20; // Assuming $movie->rating is out of 100
                                                        $totalStars = 5; // Total stars
                                                    @endphp

                                                    @for ($i = 0; $i < floor($rate); $i++)
                                                        <i class="ion ion-android-star"></i>
                                                    @endfor

                                                    @if ($rate - floor($rate) >= 0.5)
                                                        <i class="ion ion-android-star-half"></i>
                                                    @endif

                                                    @for ($i = 0; $i < ($totalStars - ceil($rate)); $i++)
                                                        <i class="ion ion-android-star-outline"></i>
                                                    @endfor

                                                    {{ number_format($rate, 1) . '/' . $totalStars }}

                                            </div>

                                            <span class="price">
                                                <del>
                                                    <span class="woocommerce-Price-amount">
                                                        <span class="woocommerce-Price-currencySymbol">£</span>9.00
                                                    </span>
                                                </del>

                                                <ins>
                                                    <span class="woocommerce-Price-amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">£</span>{{ $movie->price }}
                                                    </span>
                                                </ins>
                                            </span>

                                            <div class="description-product">
                                                {{ $movie->short_description }}
                                            </div>

                                            <div class="quanlity-product">
                                                <span class="name-field">Quanlity:</span>

                                                <!-- block input Quanlity -->
                                                <div class="bl-input-quanlity wrap-num-product">
                                                    <div class="btn-num-down" unselectable="on">
                                                        -
                                                    </div>

                                                    <input class="num-product" type="text" value="1">

                                                    <div class="btn-num-up" unselectable="on">
                                                        +
                                                    </div>
                                                </div>
                                                <!-- end block input Quanlity -->
                                            </div>

                                            <a href="javascript:;" class="btn-addcart btn-normal shape-round">
                                                Add to cart
                                            </a>

                                            <div class="categories">
                                                <span class="name-field">Categories:</span>
                                                <a href="javascript:;" class="cat-item">Documentaries,</a>
                                                <a href="javascript:;" class="cat-item">Drama</a>
                                            </div>
                                        </div>

                                        <div class="woocommerce-tabs js-call-tabs">
                                            <ul class="tabs thim-nav-tabs">
                                                <li class="item-nav active" data-panel="1">
                                                    <a>Description</a>
                                                </li>

                                                <li class="item-nav" data-panel="2">
                                                    <a>Reviews (0)</a>
                                                </li>

                                                <li class="item-nav" data-panel="3">
                                                    <a>Trailer</a>
                                                </li>
                                            </ul>

                                            <div class="thim-content-tabs">
                                                <div class="tab-panel" data-nav="1">
                                                    {!! $movie->description !!}
                                                </div>

                                                <div class="tab-panel" data-nav="2">
                                                    <p>
                                                        Reviews Content
                                                    </p>
                                                </div>

                                                <div class="tab-panel" data-nav="3">
                                                    {!!  youtube_embed($movie->trailer_url) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end block Product-detail -->
                                </div>

                                <div class="related products-list">
                                    <h2>
                                        Related Products
                                    </h2>

                                    <div class="wrap-element">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-4">
                                                <div class="item-product">
                                                    <div class="media-item">
                                                        <div class="pic">
                                                            <a href="single-shop.html"><img
                                                                    src="{{ asset('assets/images/product-05.jpg') }}"
                                                                    alt="IMG"></a>
                                                        </div>

                                                        <a href="javascript:;" class="btn-addcart">
                                                            <i class="ion ion-android-cart"></i>
                                                            Add to cart
                                                        </a>
                                                    </div>

                                                    <div class="text-item">
                                                        <h4 class="title">
                                                            <a href="single-shop.html">
                                                                Best Song CD
                                                            </a>
                                                        </h4>

                                                        <span class="price">
                                                            <del>
                                                                <span class="woocommerce-Price-amount">
                                                                    <span
                                                                        class="woocommerce-Price-currencySymbol">£</span>9.00
                                                                </span>
                                                            </del>

                                                            <ins>
                                                                <span class="woocommerce-Price-amount">
                                                                    <span
                                                                        class="woocommerce-Price-currencySymbol">£</span>7.00
                                                                </span>
                                                            </ins>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-4">
                                                <div class="item-product">
                                                    <div class="media-item">
                                                        <div class="pic">
                                                            <a href="single-shop.html"><img
                                                                    src="{{ asset('assets/images/product-06.jpg') }}"
                                                                    alt="IMG"></a>
                                                        </div>

                                                        <a href="javascript:;" class="btn-addcart">
                                                            <i class="ion ion-android-cart"></i>
                                                            Add to cart
                                                        </a>
                                                    </div>

                                                    <div class="text-item">
                                                        <h4 class="title">
                                                            <a href="single-shop.html">
                                                                Best Song CD
                                                            </a>
                                                        </h4>

                                                        <span class="price">
                                                            <del>
                                                                <span class="woocommerce-Price-amount">
                                                                    <span
                                                                        class="woocommerce-Price-currencySymbol">£</span>9.00
                                                                </span>
                                                            </del>

                                                            <ins>
                                                                <span class="woocommerce-Price-amount">
                                                                    <span
                                                                        class="woocommerce-Price-currencySymbol">£</span>7.00
                                                                </span>
                                                            </ins>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-4">
                                                <div class="item-product">
                                                    <div class="media-item">
                                                        <div class="pic">
                                                            <a href="single-shop.html"><img
                                                                    src="{{ asset('assets/images/product-07.jpg') }}"
                                                                    alt="IMG"></a>
                                                        </div>

                                                        <a href="javascript:;" class="btn-addcart">
                                                            <i class="ion ion-android-cart"></i>
                                                            Add to cart
                                                        </a>
                                                    </div>

                                                    <div class="text-item">
                                                        <h4 class="title">
                                                            <a href="single-shop.html">
                                                                Best Song CD
                                                            </a>
                                                        </h4>

                                                        <span class="price">
                                                            <span class="woocommerce-Price-amount">
                                                                <span
                                                                    class="woocommerce-Price-currencySymbol">£</span>9.00
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>

                        <div class="widget-area col-sm-9 col-md-8 col-lg-3 sticky-sidebar">
                            <livewire:sidebar />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
    <script src="assets/js/libs/sticky-sidebar/theia-sticky-sidebar.js"></script>
    @endsection
</x-guest-layout>
