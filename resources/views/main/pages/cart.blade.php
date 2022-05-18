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
                    <h2 class="title text-dark text-capitalize">cart</h2>
                </div>
            </div>
            <div class="col-12">
                <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">cart</li>
                </ol>
            </div>
        </div>
    </div>
</nav>
<!-- breadcrumb-section end -->
<!-- product tab start -->
<section class="whish-list-section theme1 pt-80 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="title mb-30 pb-25 text-capitalize">Your cart items</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center" scope="col">Product Image</th>
                            <th class="text-center" scope="col">Product Name</th>
                            <th class="text-center" scope="col">Qty</th>
                            <th class="text-center" scope="col">Price</th>
                            <th class="text-center" scope="col">action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productCart as $key => $product)
                        <tr class="tr-cart">
                            <th class="text-center" scope="row">
                                <img src="{{asset('http://127.0.0.1:8000/storage/'.$product->thumbnail)}}" alt="img">
                            </th>
                            <td class="text-center">
                                <span class="whish-title">{{$product->name}}</span>
                            </td>

                            <td class="text-center">
                                <div class="product-count style">
                                    <div class="count d-flex justify-content-center">
                                        <input class="number-product-cart" type="number" min="1" max="10" step="1" value="1" cart_id = {{$carts[$key]->id}}>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                    <span class="whish-list-price">
                                        {{$product->price - $product->price_voucher}}
                                    </span></td>

                            <td class="text-center">
                                <a href="#"> <span class="trash"><i class="fas fa-trash-alt remove-product-cart " cart_id ={{$carts[$key]->id}} ></i> </span></a>
                            </td>

                        </tr>
                        @endforeach
                        </tbody>
                    </table>
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
