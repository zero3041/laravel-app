<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOP Push</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <a href="/"><img src="images/logo.png" alt="" width="125px"></a>
                </div>
                <nav>
                    <ul id="MenuItems">
                        <li><a href="/">Home</a></li>
                        <li><a href="products">Products</a></li>
                        <li><a href="">About</a></li>
                        <li><a href="">Contact</a></li>
                        @if(Auth::guard('web')->check())
                            <li><a href="">{{ Auth::guard('web')->user()->name }}</a></li>
                            <li><a href="{{ route('logout') }}">Logout</a></li>
                        @else
                            <li><a href="{{ route('login') }}">Account</a></li>
                        @endif
                    </ul>
                </nav>
                <a href="/cart"><img src="images/cart.png" width="30px" height="30px" alt=""></a>
                <img src="{{ asset('images/menu.png') }}" onclick="menutoggle()" class="menu-icon">
            </div>
            <div class="row">
                <div class="col-2">
                    <h1>Chọn cho mình một phong cách mới <br> A new style</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo, amet ullam ipsum aliquam debitis
                        ipsa?</p>
                    <a href="" class="btn">Mua Ngay &#8594</a>
                </div>
                <div class="col-2">
                    <img src="images/image1.png" alt="">
                </div>
            </div>
        </div>
    </div>

    <!-- Categories -->
    <div class="categories">
        <div class="small-container">
            <div class="row">
                <div class="col-3">
                    <img src="images/category-1.jpg" alt="">
                </div>
                <div class="col-3">
                    <img src="images/category-1.jpg" alt="">
                </div>
                <div class="col-3">
                    <img src="images/category-1.jpg" alt="">
                </div>
            </div>
        </div>

    </div>

    <!-- product -->
    <div class="small-container">
        <h2 class="title">Featured Product</h2>
        <div class="row">
            @foreach ($product->take(4) as $products)
            <div class="col-4">
                <a href="product-details.html"><img src="{{ $products->feature_image_path }}" alt=""></a>
                <a href="product-details.html">
                    <h4>{{ $products->name }}</h4>
                </a>
                <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o"></i>
                </div>
                <p>{{ $products->discounted_price }}$</p>
            </div>
            @endforeach
        </div>
        <h2 class="title">Latest Product</h2>
        @php
            $randomCount = min(12, $product->count());
        @endphp
            <div class="row">
                @foreach ($product->random($randomCount) as $products)
                <div class="col-4">
                    <a href="product-details.html"><img src="{{ $products->feature_image_path }}" alt=""></a>
                    <a href="product-details.html">
                        <h4>{{ $products->name }}</h4>
                    </a>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <p>{{ $products->discounted_price }}$</p>
                </div>
             @endforeach
            </div>
    </div>
    <!-- offer -->

    <div class="offer">
        <div class="small-container">
            <div class="row">
                <div class="col-2">
                    <img src="images/exclusive.png" class="offfer-img" alt="">
                </div>
                <div class="col-2">
                    <p>Sản phẩm ưu đãi của cửa hàng </p>
                    <h1>Smart band 4</h1>
                    <small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias a
                        periam harum reiciendis natus odit ipsa expedita fuga mollitia quod ut quia, earum doloribus
                        voluptates animi!</small>
                    <a href="" class="btnb">Buy Now &#8594;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- test -->

    <div class="testimonial">
        <div class="small-container">
            <div class="row">
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae accusantium nihil animi nesciunt
                        saepe aliquid odit magni rerum.</p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <img src="images/user-1.png" alt="">
                    <h3>Sean Parker</h3>
                </div>
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae accusantium nihil animi nesciunt
                        saepe aliquid odit magni rerum.</p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <img src="images/user-1.png" alt="">
                    <h3>Sean Parker</h3>
                </div>
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae accusantium nihil animi nesciunt
                        saepe aliquid odit magni rerum.</p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <img src="images/user-1.png" alt="">
                    <h3>Sean Parker</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Brands -->
    <div class="brands">
        <div class="small-container">
            <div class="row">
                <div class="col-5">
                    <img src="images/logo-godrej.png" alt="">
                </div>
                <div class="col-5">
                    <img src="images/logo-oppo.png" alt="">
                </div>
                <div class="col-5">
                    <img src="images/logo-coca-cola.png" alt="">
                </div>
                <div class="col-5">
                    <img src="images/logo-paypal.png" alt="">
                </div>
                <div class="col-5">
                    <img src="images/logo-philips.png" alt="">
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col-1">
                    <h3>Tải App</h3>
                    <p>Tải ứng dụng về máy của bạn</p>
                    <div class="app-logo">
                        <img src="images/play-store.png" alt="">
                        <img src="images/app-store.png" alt="">
                    </div>
                </div>
                <div class="footer-col-2">
                    <img src="images/logo-white.png" alt="">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laborum totam deserunt distinctio
                        mollitia vel repudiandae.</p>
                </div>
                <div class="footer-col-3">
                    <h3>Useful Links</h3>
                    <ul>
                        <li>Mã giảm giá</li>
                        <li>Bài viết</li>
                        <li>Chính sách hoàn trả</li>
                        <li>Đơn vị đồng hành</li>
                    </ul>
                </div>
                <div class="footer-col-4">
                    <h3>Theo dõi chúng tôi</h3>
                    <ul>
                        <li>Facebook</li>
                        <li>Twitter</li>
                        <li>Instagram</li>
                        <li>Youtube</li>
                    </ul>
                </div>
            </div>
            <hr>
            <p class="copyright">Copyright 2022 - By Push</p>
        </div>
    </div>
    <!-- js -->

    <script>
        var MenuItems = document.getElementById("MenuItems");

        MenuItems.style.maxHeight = "0px";

        function menutoggle() {
            if (MenuItems.style.maxHeight == "0px") {
                MenuItems.style.maxHeight = "200px";
            }
            else {
                MenuItems.style.maxHeight = "0px";
            }
        }
    </script>
</body>

</html>
