@extends('layouts.app')

@section('content')
    <div class="small-container single-product">
        <div class="row">
            <div class="col-2" style="max-width: 450px;">
                <img src="{{ $product->feature_image_path }}" id="ProductImg" width="100%">

                <div class="small-img-row">
                    @foreach($product->images as $image)
                        <div class="small-img-col">
                            <img class="small-img" src="{{ $image->image_path }}" width="100$" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-2">
                <p>Home / T-Shirt</p>
                <h1>{{ $product->name }}</h1>
                <h4 style="font-size: 20px">${{ $product->discounted_price }}</h4>
                <select name="" id="">
                    <option>Select Size</option>
                    <option>XXL</option>
                    <option>XL</option>
                    <option>L</option>
                    <option>M</option>
                </select>
                <input type="number" value="1">
                <div href="" data-product-id="{{ $product->id }}" class="btn add-to-cart-btn">Add to cart</div>
                <h3>Products Details <i class="fa fa-indent"></i></h3>
                <br>
                <p>{{ $product->description }}</p>

            </div>
        </div>
    </div>
    <script>
        var MenuItems = document.getElementById("MenuItems");

        MenuItems.style.maxHeight = "0px";

        function menutoggle() {
            if (MenuItems.style.maxHeight == "0px") {
                MenuItems.style.maxHeight = "200px";
            } else {
                MenuItems.style.maxHeight = "0px";
            }
        }
    </script>

    <!-- products js -->

    <script>
        var ProductImg = document.getElementById("ProductImg");

        var SmallImg = document.getElementsByClassName("small-img");

        SmallImg[0].onclick = function () {
            ProductImg.src = SmallImg[0].src;
        }
        SmallImg[1].onclick = function () {
            ProductImg.src = SmallImg[1].src;
        }
        SmallImg[2].onclick = function () {
            ProductImg.src = SmallImg[2].src;
        }
        SmallImg[3].onclick = function () {
            ProductImg.src = SmallImg[3].src;
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
            integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function () {
            $('.add-to-cart-btn').on('click', function () {
                var productId = $(this).data('product-id');
                var quantity = $('input[type="number"]').val();

                // Gửi AJAX request
                $.ajax({
                    url: '/add-to-cart-detail',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        quantity: quantity,
                        _token: "{{ csrf_token() }}"  // Thêm token cho bảo mật
                    },
                    success: function (response) {
                        // Xử lý sau khi thêm thành công
                        alert('Đã thêm vào giỏ hàng!');
                    },
                    error: function (error) {
                        // Xử lý lỗi
                        alert('Đã xảy ra lỗi vui lòng thử lại');
                    }
                });
            });
        });

    </script>
@endsection
