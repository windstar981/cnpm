@php
$urlRoot   = \Request::root();
@endphp

<!-- header end -->
@include('main.header.header')
<section>
</section>

<!-- main slider start -->
<section class="bg-light position-relative">
    <div class="main-slider dots-style theme3">
        @foreach($banners as $banner)
        <div class="slider-item bg-img bg-img7" style="background-image: url({{$urlRoot.'/storage/'.($banner->image)}})">
            <div class="container">
                <div class="row align-items-center slider-height">
                    <div class="col-12">
                        <div class="slider-content d-inline-block text-center">
                            <p class="text text-lighten text-uppercase animated mb-25" data-animation-in="fadeInDown">
                                {{$banner->title_small}}</p>
                            <h4 class="title text-dark animated text-capitalize mb-25" data-animation-in="fadeInLeft"
                                data-delay-in="1">  {{$banner->title_medium}}</h4>
                            <h2 class="sub-title text-dark animated" data-animation-in="fadeInRight" data-delay-in="2">
                                {{$banner->title_large}}</h2>
                            <a href="#"
                               class="btn theme--btn3 btn--lg text-uppercase rounded-5 animated mt-45 mt-sm-25"
                               data-animation-in="zoomIn" data-delay-in="3">Mua ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!-- slider-item end -->
        <!-- slider-item end -->
    </div>
    <!-- slick-progress -->
    <div class="slick-progress">
        <span></span>
    </div>
    <!-- slick-progress end-->
</section>
<!-- main slider end -->
<!-- common banner  start -->
<div class="common-banner bg-white pt-80">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-30">
                <div class="banner-thumb">
                    <a href="shop-grid-4-column.html" class="zoom-in d-block overflow-hidden">
                        <img src="{{asset('assets/img/banner/30.jpg')}}" alt="banner-thumb-naile">
                    </a>
                </div>
            </div>
            <div class="col-md-6 mb-30">
                <div class="banner-thumb mb-30">
                    <a href="shop-grid-4-column.html" class="zoom-in d-block overflow-hidden">
                        <img src="{{asset('assets/img/banner/31.jpg')}}" alt="banner-thumb-naile">
                    </a>
                </div>
                <div class="banner-thumb">
                    <a href="shop-grid-4-column.html" class="zoom-in d-block overflow-hidden">
                        <img src="{{asset('assets/img/banner/32.jpg')}}" alt="banner-thumb-naile">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- common banner  end -->
<!-- product tab start -->

<!-- product tab end -->
<!-- new arrival section start -->
@foreach($categories as $category)
<section class="theme3 bg-white pb-80">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-30">
                    <h2 class="title text-dark text-capitalize">{{$category->name}}</h2>
                </div>
            </div>
            <div class="col-12">
                <div class="product-slider-init slick-nav">
                    @for($i=1 ; $i<3 ; $i++)
                    @foreach($category->product()->get() as $product)
                    <div class="slider-item">
                        <div class="card product-card">
                            <div class="card-body p-0">
                                <div class="media flex-column">
                                    <div class="product-thumbnail position-relative">
                                        <span class="badge badge-danger top-right">New</span>
                                        <a href="/product/{{$product->slug}}">
                                            <img class="first-img" src="{{$urlRoot.'/storage/'.($product->thumbnail)}}" alt="thumbnail">
                                        </a>
                                        <!-- product links -->
                                        <ul class="product-links d-flex justify-content-center">
                                            <li>
                                                <span>
                                                    <span data-toggle="tooltip" data-placement="bottom" style="cursor:pointer;"
                                                          title="add to wishlist" class="icon-heart" pr_id ="{{$product->id}}"> </span>
                                                </span>
                                            </li>


                                        </ul>
                                        <!-- product links end-->
                                    </div>
                                    <div class="media-body">
                                        <div class="product-desc">
                                            <h3 class="title"><a href="/product/{{$product->slug}}">{{$product->name}}</a></h3>
                                            @if($product->number<=0)
                                                <span>S???n ph???m ???? h???t h??ng</span>
                                            @endif
                                            <div class="star-rating">
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star de-selected"></span>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="product-price">{{$product->price-$product->price_voucher}}</h6>
                                                <button class="pro-btn"><i class="icon-basket add-to-cart" id_pr="{{$product->id}}"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- slider-item end -->
                    @endfor
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach
<!-- new arrival section end -->
<!-- popular-section  start -->
<div class="popular-section bg-lighten theme3 bg-white pt-80 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-30">
                    <h2 class="title text-dark text-capitalize">Danh m???c ph??? bi???n</h2>
                    <p class="text mt-10">M???t s??? danh m???c ph??? bi???n c???a ch??ng t??i
                    </p>
                </div>
            </div>
            <div class="col-12">
                <div class="popular-slider-init dots-style">
                    @foreach($categories as $cate)
                    <div class="slider-item">
                        <div class="card popular-card zoom-in">
                            <div class="card-body">
                                <a href="#" class="thumb-naile d-block overflow-hidden"> <img class="d-block mx-auto"
                                                                                              src="{{$urlRoot.'/storage/'.($cate->image)}}" alt="img"></a>
                                <h3 class="popular-title">
                                    <a href="#"> {{$cate->name}}
{{--                                        <span>(17)</span>--}}
                                    </a>
                                </h3>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- slider-item end -->

                </div>
            </div>
        </div>
    </div>
</div>
<!-- popular-section  end -->
<!-- brand slider start -->
<div class="brand-slider-section theme3 bg-white py-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="brand-init theme2 slick-nav-brand">
                    <div class="slider-item">
                        <div class="single-brand">
                            <a href="https://themeforest.net/user/hastech" class="brand-thumb">
                                <img src="assets/img/brand/1.jpg" alt="brand-thumb-nail">
                            </a>
                        </div>
                    </div>
                    <!-- slider-item end -->
                    <div class="slider-item">
                        <div class="single-brand">
                            <a href="https://themeforest.net/user/hastech" class="brand-thumb">
                                <img src="assets/img/brand/2.jpg" alt="brand-thumb-nail">
                            </a>
                        </div>
                    </div>
                    <!-- slider-item end -->
                    <div class="slider-item">
                        <div class="single-brand">
                            <a href="https://themeforest.net/user/hastech" class="brand-thumb">
                                <img src="assets/img/brand/3.jpg" alt="brand-thumb-nail">
                            </a>
                        </div>
                    </div>
                    <!-- slider-item end -->
                    <div class="slider-item">
                        <div class="single-brand">
                            <a href="https://themeforest.net/user/hastech" class="brand-thumb">
                                <img src="assets/img/brand/4.jpg" alt="brand-thumb-nail">
                            </a>
                        </div>
                    </div>
                    <!-- slider-item end -->
                    <div class="slider-item">
                        <div class="single-brand">
                            <a href="https://themeforest.net/user/hastech" class="brand-thumb">
                                <img src="assets/img/brand/5.jpg" alt="brand-thumb-nail">
                            </a>
                        </div>
                    </div>
                    <!-- slider-item end -->
                    <div class="slider-item">
                        <div class="single-brand">
                            <a href="https://themeforest.net/user/hastech" class="brand-thumb">
                                <img src="assets/img/brand/2.jpg" alt="brand-thumb-nail">
                            </a>
                        </div>
                    </div>
                    <!-- slider-item end -->
                    <div class="slider-item">
                        <div class="single-brand">
                            <a href="https://themeforest.net/user/hastech" class="brand-thumb">
                                <img src="assets/img/brand/3.jpg" alt="brand-thumb-nail">
                            </a>
                        </div>
                    </div>
                    <!-- slider-item end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- brand slider end -->
<!-- common banner  start -->
{{--<div class="common-banner bg-white pb-50">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-6 mb-30">--}}
{{--                <div class="banner-thumb common-bthumb1">--}}
{{--                    <a href="shop-grid-4-column.html" class="zoom-in d-block overflow-hidden">--}}
{{--                        <img src="assets/img/banner/22.jpg" alt="banner-thumb-naile">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-6 mb-30">--}}
{{--                <div class="banner-thumb common-bthumb1">--}}
{{--                    <a href="shop-grid-4-column.html" class="zoom-in d-block overflow-hidden">--}}
{{--                        <img src="assets/img/banner/23.jpg" alt="banner-thumb-naile">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- common banner  end -->
<!-- featured  slider start-->
{{--<section class="featured-slider theme3 pb-80">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12">--}}
{{--                <div class="section-title mb-30">--}}
{{--                    <h2 class="title text-dark text-capitalize">Featured products </h2>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-12">--}}
{{--                <div class="featured-init slick-nav">--}}
{{--                    <div class="slider-item">--}}
{{--                        <div class="product-list mb-30">--}}
{{--                            <div class="card product-card no-shadow">--}}
{{--                                <div class="card-body p-0">--}}
{{--                                    <div class="media">--}}
{{--                                        <div class="product-thumbnail">--}}
{{--                                            <a href="single-product.html">--}}
{{--                                                <img class="first-img" src="assets/img/new-products/1.jpg"--}}
{{--                                                     alt="thumbnail">--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body">--}}
{{--                                            <div class="product-desc">--}}
{{--                                                <h3 class="title"><a href="shop-grid-4-column.html">New Luxury--}}
{{--                                                        Men's Slim Fit Shirt Short Sleeve...</a></h3>--}}
{{--                                                <div class="star-rating">--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star de-selected"></span>--}}
{{--                                                </div>--}}
{{--                                                <div class="d-flex align-items-center justify-content-between">--}}
{{--                                                    <h6 class="product-price">$11.90</h6>--}}
{{--                                                    <button class="pro-btn" data-toggle="modal"--}}
{{--                                                            data-target="#add-to-cart"><i class="icon-basket"></i></button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- "product-list End -->--}}
{{--                        <div class="product-list">--}}
{{--                            <div class="card product-card no-shadow">--}}
{{--                                <div class="card-body p-0">--}}
{{--                                    <div class="media">--}}
{{--                                        <div class="product-thumbnail">--}}
{{--                                            <a href="single-product.html">--}}
{{--                                                <img class="first-img" src="assets/img/new-products/2.jpg"--}}
{{--                                                     alt="thumbnail">--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body">--}}
{{--                                            <div class="product-desc">--}}
{{--                                                <h3 class="title"><a href="shop-grid-4-column.html">Juicy Couture Solid--}}
{{--                                                        Sleeve Puffer Jacket</a></h3>--}}
{{--                                                <div class="star-rating">--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star de-selected"></span>--}}
{{--                                                </div>--}}
{{--                                                <div class="d-flex align-items-center justify-content-between">--}}
{{--                                                    <h6 class="product-price">$11.90</h6>--}}
{{--                                                    <button class="pro-btn" data-toggle="modal"--}}
{{--                                                            data-target="#add-to-cart"><i class="icon-basket"></i></button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- "product-list End -->--}}
{{--                    </div>--}}
{{--                    <!-- slider-item End -->--}}
{{--                    <div class="slider-item">--}}
{{--                        <div class="product-list mb-30">--}}
{{--                            <div class="card product-card no-shadow">--}}
{{--                                <div class="card-body p-0">--}}
{{--                                    <div class="media">--}}
{{--                                        <div class="product-thumbnail">--}}
{{--                                            <a href="single-product.html">--}}
{{--                                                <img class="first-img" src="assets/img/new-products/3.jpg"--}}
{{--                                                     alt="thumbnail">--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body">--}}
{{--                                            <div class="product-desc">--}}
{{--                                                <h3 class="title"><a href="shop-grid-4-column.html">New Balance Fresh--}}
{{--                                                        Foam LAZR v1 Sport</a></h3>--}}
{{--                                                <div class="star-rating">--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star de-selected"></span>--}}
{{--                                                </div>--}}
{{--                                                <div class="d-flex align-items-center justify-content-between">--}}
{{--                                                    <h6 class="product-price"><del class="del">$23.90</del>--}}
{{--                                                        <span class="onsale">$21.51</span></h6>--}}
{{--                                                    <button class="pro-btn" data-toggle="modal"--}}
{{--                                                            data-target="#add-to-cart"><i class="icon-basket"></i></button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- "product-list End -->--}}
{{--                        <div class="product-list">--}}
{{--                            <div class="card product-card no-shadow">--}}
{{--                                <div class="card-body p-0">--}}
{{--                                    <div class="media">--}}
{{--                                        <div class="product-thumbnail">--}}
{{--                                            <a href="single-product.html">--}}
{{--                                                <img class="first-img" src="assets/img/new-products/4.jpg"--}}
{{--                                                     alt="thumbnail">--}}
{{--                                                <img class="second-img" src="assets/img/new-products/4.1.jpg"--}}
{{--                                                     alt="thumbnail">--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body">--}}
{{--                                            <div class="product-desc">--}}
{{--                                                <h3 class="title"><a href="shop-grid-4-column.html">Hooded Wind and--}}
{{--                                                        Water Resistant Shell</a></h3>--}}
{{--                                                <div class="star-rating">--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star de-selected"></span>--}}
{{--                                                </div>--}}
{{--                                                <div class="d-flex align-items-center justify-content-between">--}}
{{--                                                    <h6 class="product-price">$11.90</h6>--}}
{{--                                                    <button class="pro-btn" data-toggle="modal"--}}
{{--                                                            data-target="#add-to-cart"><i class="icon-basket"></i></button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- "product-list End -->--}}
{{--                    </div>--}}
{{--                    <!-- slider-item End -->--}}
{{--                    <div class="slider-item">--}}
{{--                        <div class="product-list mb-30">--}}
{{--                            <div class="card product-card no-shadow">--}}
{{--                                <div class="card-body p-0">--}}
{{--                                    <div class="media">--}}
{{--                                        <div class="product-thumbnail">--}}
{{--                                            <a href="single-product.html">--}}
{{--                                                <img class="first-img" src="assets/img/new-products/5.jpg"--}}
{{--                                                     alt="thumbnail">--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body">--}}
{{--                                            <div class="product-desc">--}}
{{--                                                <h3 class="title"><a href="shop-grid-4-column.html">New Balance Fresh--}}
{{--                                                        Foam Kaymin</a></h3>--}}
{{--                                                <div class="star-rating">--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star de-selected"></span>--}}
{{--                                                </div>--}}
{{--                                                <div class="d-flex align-items-center justify-content-between">--}}
{{--                                                    <h6 class="product-price">$11.90</h6>--}}
{{--                                                    <button class="pro-btn" data-toggle="modal"--}}
{{--                                                            data-target="#add-to-cart"><i class="icon-basket"></i></button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- "product-list End -->--}}
{{--                        <div class="product-list">--}}
{{--                            <div class="card product-card no-shadow">--}}
{{--                                <div class="card-body p-0">--}}
{{--                                    <div class="media">--}}
{{--                                        <div class="product-thumbnail">--}}
{{--                                            <a href="single-product.html">--}}
{{--                                                <img class="first-img" src="assets/img/new-products/6.jpg"--}}
{{--                                                     alt="thumbnail">--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body">--}}
{{--                                            <div class="product-desc">--}}
{{--                                                <h3 class="title"><a href="shop-grid-4-column.html">Juicy Couture Tricot--}}
{{--                                                        Logo Stripe Jacket</a></h3>--}}
{{--                                                <div class="star-rating">--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star de-selected"></span>--}}
{{--                                                </div>--}}
{{--                                                <div class="d-flex align-items-center justify-content-between">--}}
{{--                                                    <h6 class="product-price">$11.90</h6>--}}
{{--                                                    <button class="pro-btn" data-toggle="modal"--}}
{{--                                                            data-target="#add-to-cart"><i class="icon-basket"></i></button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- "product-list End -->--}}
{{--                    </div>--}}
{{--                    <!-- slider-item End -->--}}
{{--                    <div class="slider-item">--}}
{{--                        <div class="product-list mb-30">--}}
{{--                            <div class="card product-card no-shadow">--}}
{{--                                <div class="card-body p-0">--}}
{{--                                    <div class="media">--}}
{{--                                        <div class="product-thumbnail">--}}
{{--                                            <a href="single-product.html">--}}
{{--                                                <img class="first-img" src="assets/img/new-products/1.1.jpg"--}}
{{--                                                     alt="thumbnail">--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body">--}}
{{--                                            <div class="product-desc">--}}
{{--                                                <h3 class="title"><a href="shop-grid-4-column.html">Juicy Couture Juicy--}}
{{--                                                        Quilted Terry Track Jacket</a></h3>--}}
{{--                                                <div class="star-rating">--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star de-selected"></span>--}}
{{--                                                </div>--}}
{{--                                                <div class="d-flex align-items-center justify-content-between">--}}
{{--                                                    <h6 class="product-price">$11.90</h6>--}}
{{--                                                    <button class="pro-btn" data-toggle="modal"--}}
{{--                                                            data-target="#add-to-cart"><i class="icon-basket"></i></button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- "product-list End -->--}}
{{--                        <div class="product-list">--}}
{{--                            <div class="card product-card no-shadow">--}}
{{--                                <div class="card-body p-0">--}}
{{--                                    <div class="media">--}}
{{--                                        <div class="product-thumbnail">--}}
{{--                                            <a href="single-product.html">--}}
{{--                                                <img class="first-img" src="assets/img/new-products/4.1.jpg"--}}
{{--                                                     alt="thumbnail">--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body">--}}
{{--                                            <div class="product-desc">--}}
{{--                                                <h3 class="title"><a href="shop-grid-4-column.html">Couture Juicy--}}
{{--                                                        Quilted Terry Track Jacket</a></h3>--}}
{{--                                                <div class="star-rating">--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star de-selected"></span>--}}
{{--                                                </div>--}}
{{--                                                <div class="d-flex align-items-center justify-content-between">--}}
{{--                                                    <h6 class="product-price">$11.90</h6>--}}
{{--                                                    <button class="pro-btn" data-toggle="modal"--}}
{{--                                                            data-target="#add-to-cart"><i class="icon-basket"></i></button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- "product-list End -->--}}
{{--                    </div>--}}
{{--                    <!-- slider-item End -->--}}
{{--                    <div class="slider-item">--}}
{{--                        <div class="product-list mb-30">--}}
{{--                            <div class="card product-card no-shadow">--}}
{{--                                <div class="card-body p-0">--}}
{{--                                    <div class="media">--}}
{{--                                        <div class="product-thumbnail">--}}
{{--                                            <a href="single-product.html">--}}
{{--                                                <img class="first-img" src="assets/img/new-products/1.jpg"--}}
{{--                                                     alt="thumbnail">--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body">--}}
{{--                                            <div class="product-desc">--}}
{{--                                                <h3 class="title"><a href="shop-grid-4-column.html">Fila Locker Room--}}
{{--                                                        Varsity Jacket</a></h3>--}}
{{--                                                <div class="star-rating">--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star de-selected"></span>--}}
{{--                                                </div>--}}
{{--                                                <div class="d-flex align-items-center justify-content-between">--}}
{{--                                                    <h6 class="product-price">$11.90</h6>--}}
{{--                                                    <button class="pro-btn" data-toggle="modal"--}}
{{--                                                            data-target="#add-to-cart"><i class="icon-basket"></i></button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- "product-list End -->--}}
{{--                        <div class="product-list">--}}
{{--                            <div class="card product-card no-shadow">--}}
{{--                                <div class="card-body p-0">--}}
{{--                                    <div class="media">--}}
{{--                                        <div class="product-thumbnail">--}}
{{--                                            <a href="single-product.html">--}}
{{--                                                <img class="first-img" src="assets/img/new-products/4.jpg"--}}
{{--                                                     alt="thumbnail">--}}
{{--                                                <img class="second-img" src="assets/img/new-products/4.1.jpg"--}}
{{--                                                     alt="thumbnail">--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body">--}}
{{--                                            <div class="product-desc">--}}
{{--                                                <h3 class="title"><a href="shop-grid-4-column.html">Calvin Klein Jeans--}}
{{--                                                        Reflective Logo Full Zip</a></h3>--}}
{{--                                                <div class="star-rating">--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star"></span>--}}
{{--                                                    <span class="ion-ios-star de-selected"></span>--}}
{{--                                                </div>--}}
{{--                                                <div class="d-flex align-items-center justify-content-between">--}}
{{--                                                    <h6 class="product-price">$11.90</h6>--}}
{{--                                                    <button class="pro-btn" data-toggle="modal"--}}
{{--                                                            data-target="#add-to-cart"><i class="icon-basket"></i></button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- "product-list End -->--}}
{{--                    </div>--}}
{{--                    <!-- slider-item End -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
<!-- featured  slider end-->
<!-- staic media start -->
{{--<section class="static-media-section theme-bg3 py-45">--}}
{{--    <div class="container">--}}
{{--        <div class="static-media-wrap p-0">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-3 col-sm-6 py-3">--}}
{{--                    <div class="d-flex static-media2 flex-column flex-sm-row">--}}
{{--                        <img class="align-self-center mb-2 mb-sm-0 mr-auto  mr-sm-3" src="assets/img/icon/2.png"--}}
{{--                             alt="icon">--}}
{{--                        <div class="media-body">--}}
{{--                            <h4 class="title text-capitalize text-white">Free Shipping</h4>--}}
{{--                            <p class="text text-white">On all orders over $75.00</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-sm-6 py-3">--}}
{{--                    <div class="d-flex static-media2 flex-column flex-sm-row">--}}
{{--                        <img class="align-self-center mb-2 mb-sm-0 mr-auto  mr-sm-3" src="assets/img/icon/3.png"--}}
{{--                             alt="icon">--}}
{{--                        <div class="media-body">--}}
{{--                            <h4 class="title text-capitalize text-white">Free Returns</h4>--}}
{{--                            <p class="text text-white">Returns are free within 9 days</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-sm-6 py-3">--}}
{{--                    <div class="d-flex static-media2 flex-column flex-sm-row">--}}
{{--                        <img class="align-self-center mb-2 mb-sm-0 mr-auto  mr-sm-3" src="assets/img/icon/5.png"--}}
{{--                             alt="icon">--}}
{{--                        <div class="media-body">--}}
{{--                            <h4 class="title text-capitalize text-white">Support 24/7</h4>--}}
{{--                            <p class="text text-white">Contact us 24 hours a day</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-sm-6 py-3">--}}
{{--                    <div class="d-flex static-media2 flex-column flex-sm-row">--}}
{{--                        <img class="align-self-center mb-2 mb-sm-0 mr-auto  mr-sm-3" src="assets/img/icon/4.png"--}}
{{--                             alt="icon">--}}
{{--                        <div class="media-body">--}}
{{--                            <h4 class="title text-capitalize text-white">100% Payment Secure</h4>--}}
{{--                            <p class="text text-white">Your payment are safe with us.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
<!-- staic media end -->
<!-- brand slider start -->
<!-- footer strat -->

@include('main.footer.footer')

<!-- footer end -->

<!-- modals start -->
<!-- first modal -->
<div class="modal fade theme3 style1" id="quick-view" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 mx-auto col-lg-5 mb-5 mb-lg-0">
                        <div class="product-sync-init mb-20">
                            <div class="single-product">
                                <div class="product-thumb">
                                    <img src="assets/img/hot-deals/thumb/4.jpg" alt="product-thumb">
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <img src="assets/img/hot-deals/thumb/5.jpg" alt="product-thumb">
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <img src="assets/img/hot-deals/thumb/6.jpg" alt="product-thumb">
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <img src="assets/img/hot-deals/thumb/7.jpg" alt="product-thumb">
                                </div>
                            </div>
                            <!-- single-product end -->
                        </div>

                        <div class="product-sync-nav">
                            <div class="single-product">
                                <div class="product-thumb">
                                    <a href="javascript:void(0)"> <img src="assets/img/hot-deals/thumb/4.2x.jpg"
                                                                       alt="product-thumb"></a>
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <a href="javascript:void(0)"> <img src="assets/img/hot-deals/thumb/5.2x.jpg"
                                                                       alt="product-thumb"></a>
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <a href="javascript:void(0)"><img src="assets/img/hot-deals/thumb/6.2x.jpg"
                                                                      alt="product-thumb"></a>
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <a href="javascript:void(0)"><img src="assets/img/hot-deals/thumb/7.2x.jpg"
                                                                      alt="product-thumb"></a>
                                </div>
                            </div>
                            <!-- single-product end -->
                        </div>
                    </div>
                    <div class="col-lg-7 mt-5 mt-md-0">
                        <div class="modal-product-info">
                            <div class="product-head">
                                <h2 class="title">New Balance Running Arishi trainers in triple</h2>
                                <h4 class="sub-title">Reference: demo_5</h4>
                                <div class="star-content mb-20">
                                    <span class="star-on"><i class="fas fa-star"></i> </span>
                                    <span class="star-on"><i class="fas fa-star"></i> </span>
                                    <span class="star-on"><i class="fas fa-star"></i> </span>
                                    <span class="star-on"><i class="fas fa-star"></i> </span>
                                    <span class="star-on"><i class="fas fa-star"></i> </span>
                                </div>
                            </div>
                            <div class="product-body mb-40">
                                <div class="d-flex align-items-center mb-30">
                                    <h6 class="product-price"><del class="del">$23.90</del>
                                        <span class="onsale">$21.51</span></h6>
                                    <span class="badge position-static bg-dark p-2 rounded-0 ml-2">Save 10%</span>
                                </div>
                                <p>Break old records and make new goals in the New Balance?? Arishi Sport v1.</p>
                                <ul>
                                    <li>Predecessor: None.</li>
                                    <li>Support Type: Neutral.</li>
                                    <li>Cushioning: High energizing cushioning.</li>
                                </ul>
                            </div>
                            <div class="product-footer">
                                <div class="product-count style d-flex flex-column flex-sm-row my-4">
                                    <div class="count d-flex">
                                        <input type="number" min="1" max="10" step="1" value="1">
                                        <div class="button-group">
                                            <button class="count-btn increment"><i
                                                        class="fas fa-chevron-up"></i></button>
                                            <button class="count-btn decrement"><i
                                                        class="fas fa-chevron-down"></i></button>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn theme-btn--dark3 btn--xl mt-5 mt-sm-0 rounded-5">
                                            <span class="mr-2"><i class="ion-android-add"></i></span>
                                            Add to cart
                                        </button>
                                    </div>
                                </div>
                                <div class="addto-whish-list">
                                    <a href="#"><i class="icon-heart"></i> Add to wishlist</a>
                                    <a href="#"><i class="icon-shuffle"></i> Add to compare</a>
                                </div>
                                <div class="pro-social-links mt-10">
                                    <ul class="d-flex align-items-center">
                                        <li class="share">Share</li>
                                        <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                        <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                        <li><a href="#"><i class="ion-social-google"></i></a></li>
                                        <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- second modal -->
<div class="modal fade style2" id="compare" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="title"><i class="fa fa-check"></i> Product added to compare.</h5>
            </div>
        </div>
    </div>
</div>
<!-- second modal -->
<div class="modal fade style3" id="add-to-cart" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center bg-dark">
                <h5 class="modal-title" id="add-to-cartCenterTitle"> <span class="ion-checkmark-round"></span>
                    Product successfully added to your shopping cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-5 divide-right">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="assets/img/hot-deals/thumb/4.2x.jpg" alt="img">
                            </div>
                            <div class="col-md-6 mb-2 mb-md-0">
                                <h4 class="product-name">New Balance Running Arishi trainers in triple</h4>
                                <h5 class="price">$$29.00</h5>
                                <h6 class="color"><strong>Dimension: </strong>: <span class="dmc">40x60cm</span> </h6>
                                <h6 class="quantity"><strong>Quantity:</strong>&nbsp;1</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="modal-cart-content">
                            <p class="cart-products-count">There is 1 item in your cart.</p>
                            <p><strong>Total products:</strong>&nbsp;$123.72</p>
                            <p><strong>Total shipping:</strong>&nbsp;$7.00 </p>
                            <p><strong>Taxes</strong>&nbsp;$0.00</p>
                            <p><strong>Total:</strong>&nbsp;$130.72 (tax excl.)</p>
                            <div class="cart-content-btn">
                                <button type="button" class="btn theme-btn--dark3 btn--md mt-4"
                                        data-dismiss="modal">Continue
                                    shopping</button>
                                <button class="btn theme-btn--dark3 btn--md mt-4"><i
                                            class="ion-checkmark-round"></i>Proceed to
                                    checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modals end -->



<!--***********************
    all js files
 ***********************-->

<!--******************************************************
    jquery,modernizr ,poppe,bootstrap,plugins and main js
 ******************************************************-->


<!-- Use the minified version files listed below for better performance and remove the files listed above -->

<!--***************************
      Minified  js
 ***************************-->

<!--***********************************
     vendor,plugins and main js
  ***********************************-->

<!-- <script src="assets/js/vendor/vendor.min.js"></script>
<script src="assets/js/plugins/plugins.min.js"></script>
<script src="assets/js/main.js"></script> -->


