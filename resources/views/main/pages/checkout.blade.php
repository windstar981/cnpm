<!DOCTYPE html>
<html lang="en">


<!-- header start -->
@include('main.header.header')
<!-- header end -->
<!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-15">
                    <h2 class="title text-dark text-capitalize">check out</h2>
                </div>
            </div>
            <div class="col-12">
                <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">check out</li>
                </ol>
            </div>
        </div>
    </div>
</nav>
<!-- breadcrumb-section end -->
<!-- product tab start -->
<section class="check-out-section pt-80 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-30">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                    Thông tin người nhận
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                             data-parent="#accordion">
                            <div class="card-body">
                                    <div class="form-group row">
                                        <label for="lastname" class="col-md-3 col-form-label">Tên người nhận</label>
                                        <div class="col-md-6">
                                            <input type="text" id="name" value="{{$customer->name}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-md-3 col-form-label">Email</label>
                                        <div class="col-md-6">
                                            <input type="email" id="email" class="form-control" value="{{$customer->email}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-md-3 col-form-label">Địa chỉ</label>
                                        <div class="col-md-6">
                                            <input type="email" id="address" class="form-control" value="{{$customer->address}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-md-3 col-form-label">Số điện thoại</label>
                                        <div class="col-md-6">
                                            <input type="email" id="telephone" class="form-control" value="{{$customer->telephone}}">
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-30">
                <ul class="list-group cart-summary rounded-0">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <ul class="items">
                            @isset($carts)
                                @foreach($carts as $key => $product)
                                <li>{{$product->quantity}} x {{$productCarts[$key]->name}}</li>
                                @endforeach
                            @endif
                        </ul>
                        <ul class="amount">
                            @isset($carts)
                                <?php
                                    $total = 0;
                                ?>
                                @foreach($carts as $key => $product)
                                    <li>{{($productCarts[$key]->price - $productCarts[$key]->price_voucher)*$product->quantity}} </li>

                                        <p style="display: none">{{$total +=     ($productCarts[$key]->price - $productCarts[$key]->price_voucher)*$product->quantity}}</p>

                                @endforeach
                            @endif
                        </ul>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <ul class="items">
                            <li>Shipping</li>
                            <li>Total (tax excl.)</li>
                        </ul>
                        <ul class="amount">
                            <li>20000</li>
                            <li class="total">{{$total+20000}}</li>
                        </ul>
                    </li>
                    <li class="list-group-item text-center">
                        <button class="btn theme-btn--dark1 btn--md checkout">Đặt hàng</button>
                    </li>
                </ul>

                <div class="delivery-info mt-20">
                    <ul>
                        <li>
                            <img src="assets/img/icon/10.png" alt="icon"> An toàn bảo mật
                        </li>
                        <li>
                            <img src="assets/img/icon/11.png" alt="icon"> Giao hàng tận nơi
                        </li>
                        <li class="mb-0">
                            <img src="assets/img/icon/12.png" alt="icon"> Hoàn trả miễn phí
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product tab end -->
<!-- footer strat -->
@include('main.footer.footer')
<!-- footer end -->



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


</body>

</html>
