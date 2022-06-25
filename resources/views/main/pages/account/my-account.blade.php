
<!DOCTYPE html>
<html lang="en">

<!-- header start -->
@include('main.header.header')
<nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-15">
                    <h2 class="title text-dark text-capitalize">my account</h2>
                </div>
            </div>
            <div class="col-12">
                <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">my account</li>
                </ol>
            </div>
        </div>
    </div>
</nav>
<div class="site-wrapper mb-4 mt-3" id="top">
    <div class="container d-block">
        <div class="row ">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">

                <div class="d-flex flex-column flex-shrink-0 p-3 bg-light">
                    <div class="d-flex align-items-center  mb-md-0 m-auto link-dark text-decoration-none">
                        <span class="fs-4 font-weight-bold"> Xin chào, {{$name}}  </span>
                    </div>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="{{route('get.account.index')}}" class="nav-link active" aria-current="page">
                                Thông tin cá nhân
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('get.password.index')}}" class="nav-link  " aria-current="page">
                                Đổi mật khẩu
                            </a>
                        </li>
                        <li>
                            <a href="{{route('customer.logout')}}" class="nav-link link-dark">
                                Đăng xuất
                            </a>
                        </li>

                    </ul>
                    <hr>

                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12">
                <H4 class="mb-4 font-weight-bold">THÔNG TIN TÀI KHOẢN</H4>
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
                <form class="" action="{{route('post.account.store')}}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label for="inputname" class="col-sm-2 col-form-label">Họ và tên</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" value="{{$name}}" class="form-control" id="inputname">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" value="{{$email}}" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="inputText1" class="col-sm-2 col-form-label">Số điện thoại</label>
                        <div class="col-sm-10">
                            <input type="text" name="telephone" value="{{$telephone}}" class="form-control" id="inputText1">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputText2" class="col-sm-2 col-form-label">Địa chỉ</label>
                        <div class="col-sm-10">
                            <input type="text" name="address" value="{{$address}}" class="form-control" id="inputText2">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="m-auto">
                            <button type="submit" class="btn btn-primary">
                                Lưu thay đổi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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