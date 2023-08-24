@extends('products.app')


@section('content')
    <div class="small-container single-product">
        <div class="row">
            <div class="col-2">
                <img src="images/gallery-1.jpg" id="ProductImg" width="100%">

                <div class="small-img-row">
                    <div class="small-img-col">
                        <img class="small-img" src="images/gallery-1.jpg" width="100$" alt="">
                    </div>
                    <div class="small-img-col">
                        <img class="small-img" src="images/gallery-2.jpg" width="100$" alt="">
                    </div>
                    <div class="small-img-col">
                        <img class="small-img" src="images/gallery-3.jpg" width="100$" alt="">
                    </div>
                    <div class="small-img-col">
                        <img class="small-img" src="images/gallery-4.jpg" width="100$" alt="">
                    </div>
                </div>
            </div>
            <div class="col-2">
                <p>Home / T-Shirt</p>
                <h1>Áo đỏ lịch lãm</h1>
                <h4>250 000 đ</h4>
                <select name="" id="">
                    <option>Select Size</option>
                    <option>XXL</option>
                    <option>XL</option>
                    <option>L</option>
                    <option>M</option>
                </select>
                <input type="number" value="1">
                <a href="" class="btn">Add to cart</a>
                <h3>Products Details <i class="fa fa-indent"></i></h3>
                <br>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore repellendus delectus quo expedita fuga dolorem?</p>

            </div>
        </div>
    </div>
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

    <!-- products js -->

    <script>
        var ProductImg = document.getElementById("ProductImg");

        var SmallImg = document.getElementsByClassName("small-img");

        SmallImg[0].onclick = function(){
            ProductImg.src = SmallImg[0].src;
        }
        SmallImg[1].onclick = function(){
            ProductImg.src = SmallImg[1].src;
        }
        SmallImg[2].onclick = function(){
            ProductImg.src = SmallImg[2].src;
        }
        SmallImg[3].onclick = function(){
            ProductImg.src = SmallImg[3].src;
        }
    </script>
@endsection
