<!DOCTYPE html>
<html lang="en">

@php
    $urlRoot = \Request::root();
    $productImages = json_decode($product->images);
    $attr = json_decode($product->attribute);
@endphp

<!-- header start -->
@include('main.header.header')
<!-- header end -->
<!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme3 bg-lighten2 pt-110 pb-110">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="shop-grid-3-column.html">Product</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
                </ol>
            </div>
        </div>
    </div>
</nav>
<!-- breadcrumb-section end -->
<!-- product-single start -->
<section class="product-single theme3 pt-60">
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        <div class="row">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="position-relative">
                    <span class="badge badge-danger top-right">New</span>
                </div>
                <div class="product-sync-init mb-20">
                    @foreach($productImages as $image)
                    <div class="single-product">
                        <div class="product-thumb">
                            <img src="{{$urlRoot .'/storage/'.$image}}" alt="product-thumb">
                        </div>
                    </div>
                    @endforeach
                    <!-- single-product end -->
                </div>

                <div class="product-sync-nav single-product">
                    @foreach($productImages as $image)
                    <div class="single-product">
                        <div class="product-thumb">
                            <a href="javascript:void(0)"> <img src="{{$urlRoot .'/storage/'.$image}}"
                                                               alt="product-thumb"></a>
                        </div>
                    </div>
                    <!-- single-product end -->
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-md-0">
                <div class="single-product-info">
                    <div class="single-product-head">
                        <h2 class="title mb-20">{{$product->name}}</h2>
                        <div class="star-content mb-20">
                            <span class="star-on"><i class="ion-ios-star"></i> </span>
                            <span class="star-on"><i class="ion-ios-star"></i> </span>
                            <span class="star-on"><i class="ion-ios-star"></i> </span>
                            <span class="star-on"><i class="ion-ios-star"></i> </span>
                            <span class="star-on"><i class="ion-ios-star"></i> </span>
                            <a href="#" id="write-comment"><span class="ml-2"><i class="far fa-comment-dots"></i></span>
                                Đọc đánh giá <span>({{$rates->count()}})</span></a>
                            <a href="#" data-toggle="modal" data-target="#exampleModalCenter"><span class="edite"><i
                                            class="far fa-edit"></i></span> Viết một đánh giá</a>
                        </div>
                    </div>
                    <div class="product-body mb-40">
                        <div class="d-flex align-items-center mb-30">
                            <h6 class="product-price mr-20"><del class="del">{{$product->price}}VNĐ</del>
                                <span class="onsale">{{$product->price -  $product->price_voucher }}</span></h6>
                            <span class="badge position-static bg-dark rounded-0">Save 10%</span>
                        </div>
                        <p>{{mb_substr($product->description, 0, 100)}}</p>
                    </div>
                    <div class="product-footer">
                        <div class="product-count style d-flex flex-column flex-sm-row mt-30 mb-20">
                            <div class="count d-flex">
                                <input type="number" min="1" max="10" step="1" value="1">
                                <div class="button-group">
                                    <button class="count-btn increment"><i class="fas fa-chevron-up"></i></button>
                                    <button class="count-btn decrement"><i class="fas fa-chevron-down"></i></button>
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
</section>
<!-- product-single end -->
<!-- product tab start -->
<div class="product-tab theme3 bg-white pt-60 pb-80">
    <div class="container">
        <div class="product-tab-nav">
            <div class="row align-items-center">
                <div class="col-12">
                    <nav class="product-tab-menu single-product">
                        <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                                   aria-controls="pills-home" aria-selected="true">Mô tả sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
                                   role="tab" aria-controls="pills-contact" aria-selected="false">Nhận xét</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- product-tab-nav end -->
        <div class="row">
            <div class="col-12">
                <div class="tab-content" id="pills-tabContent">
                    <!-- first tab-pane -->
                    <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="single-product-desc">
                            {!! nl2br($product->description) !!}
                        </div>
                    </div>
                    <!-- second tab-pane -->
                    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel"
                         aria-labelledby="pills-profile-tab">
                        <div class="single-product-desc">
                            <div class="product-features">
                                <ul>
                                    @if(isset($attr['brand']) and !empty($attr['brand']))
                                    <li><span>Thương hiệu</span></li>
                                    <li><span>{{$attr['brand']}}</span></li>
                                    @endif
                                    @if(isset($attr['origin']) and !empty($attr['origin']))
                                        <li><span>Xuất sứ</span></li>
                                        <li><span>{{$attr['origin']}}</span></li>
                                        @endif
                                        @if(isset($attr['odor']) and !empty($attr['odor']))
                                        <li><span>Mùi hương</span></li>
                                        <li><span>{{$attr['odor']}}</span></li>
                                            @endif
                                        @if(isset($attr['capacity']) and !empty($attr['capacity']))
                                            <li><span>Dung tích</span></li>
                                            <li><span>{{$attr['capacity']}}</span></li>
                                        @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- third tab-pane -->
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="single-product-desc">
                            @foreach($rates as $rate)
                            <hr class="hr">
                            <div class="grade-content">
                                <p>{{$rate->created_at}}</p>
                                <h4 class="title">{{$rate->customer->name}}</h4>
                                <p>{{$rate->content}}</p>

                            </div>
                            @endforeach
                            @if(auth()->user())
                                <a href="#" class="btn theme-btn--dark3 theme-btn--dark3-sm btn--sm rounded-5 mt-15"
                                   data-toggle="modal" data-target="#exampleModalCenter">Viết đánh giá của bạn !</a>
                                @else
                                    <a href="{{route('login')}}" class="btn theme-btn--dark3 theme-btn--dark3-sm btn--sm rounded-5 mt-20">Đăng nhập để viết đánh giá</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- product tab end -->
<!-- new arrival section start -->
<section class="theme3 bg-white pb-80">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-30">
                    <h2 class="title text-dark text-capitalize">Sản phẩm tương tự</h2>
                    <p class="text mt-10">Một số sản phẩm tương tự bạn có thể thích
                    </p>
                </div>
            </div>
            <div class="col-12">
                <div class="product-slider-init slick-nav">
                    @foreach($sameProduct as $value)
                        <div class="slider-item">
                            <div class="card product-card">
                                <div class="card-body p-0">
                                    <div class="media flex-column">
                                        <div class="product-thumbnail position-relative">
                                            <span class="badge badge-danger top-right">New</span>
                                            <a href="/product/{{$value->slug}}">
                                                <img class="first-img" src="{{$urlRoot.'/storage/'.($value->thumbnail)}}" alt="thumbnail">
                                            </a>
                                            <!-- product links -->
                                            <ul class="product-links d-flex justify-content-center">
                                                <li>
                                                    <a href="wishlist.html">
                                                    <span data-toggle="tooltip" data-placement="bottom"
                                                          title="add to wishlist" class="icon-heart"> </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" data-toggle="modal" data-target="#compare">
                                                    <span data-toggle="tooltip" data-placement="bottom"
                                                          title="Add to compare" class="icon-shuffle"></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" data-toggle="modal" data-target="#quick-view">
                                                    <span data-toggle="tooltip" data-placement="bottom"
                                                          title="Quick view" class="icon-magnifier"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- product links end-->
                                        </div>
                                        <div class="media-body">
                                            <div class="product-desc">
                                                <h3 class="title"><a href="/product/{{$value->slug}}">{{$value->name}}</a></h3>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h6 class="product-price">{{$value->price-$value->price_voucher}}Đ</h6>
                                                    <button class="pro-btn"><i class="icon-basket add-to-cart" id_pr="{{$value->id}}"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                    <!-- slider-item end -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- third modal -->
<div class="modal fade show style4" id="exampleModalCenter" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-block">
                <h5 class="modal-title bg-dark text-white">Viết đánh giá của bạn</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="modal-thumb">
                            <img src="{{$urlRoot .'/storage/'.$product->thumbnail}}" alt="modal-thumb">
                            <h3 class="title">{{$product->name}}</h3>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4 mt-md-0">
                        <div class="modal-form">
                            <h3 class="title">Viết đánh giá của bạn</h3>
                            <form action="{{route('post.rate.store')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="text-filed21">Your review <sup class="required">*</sup></label>
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <textarea class="form-control textarea" name="content_rate" id="text-filed21" rows="3"></textarea>
                                </div>
                            <div class="form-group mt-3">
                                <div class="text-right">
                                    <button type="submit"
                                            class="btn theme-btn--dark3 theme-btn--dark3-sm btn--sm rounded-5">Gửi</button>
                                    <span class="d-inline-block mx-2 or">or </span>
                                    <button type="button"
                                            class="btn theme-btn--dark3 theme-btn--dark3-sm btn--sm rounded-5"
                                            data-dismiss="modal">Xóa</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modals end -->


@include('main.footer.footer')

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





</html>