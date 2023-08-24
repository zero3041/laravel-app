@extends('products.app')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
@endsection

@section('content')

<div id="grid">
    {{ $products->links("vendor.pagination.bootstrap-4") }}
    @foreach( $products as $productItem )
        <div class="product">

            <!-- Default checked -->

            <div class="info-large">
                <h4>{{ $productItem->name }}</h4>
                <div class="sku">
                    PRODUCT SKU: <strong>{{ $productItem->sku }}</strong>
                </div>

                <div class="price-big">
                    <span>${{ $productItem->original_price }}</span> ${{ $productItem->discounted_price }}
                </div>

                <h3>COLORS</h3>
                <div class="colors-large">
                    <ul>
                        <li><a href="" style="background:#222"><span></span></a></li>
                        <li><a href="" style="background:#6e8cd5"><span></span></a></li>
                        <li><a href="" style="background:#f56060"><span></span></a></li>
                        <li><a href="" style="background:#44c28d"><span></span></a></li>
                    </ul>
                </div>

                <h3>SIZE</h3>
                <div class="sizes-large">
                    <span>XS</span>
                    <span>S</span>
                    <span>M</span>
                    <span>L</span>
                    <span>XL</span>
                    <span>XXL</span>
                </div>

                <button class="add-cart-large">Add To Cart</button>

            </div>
            <div class="make3D">
                <div class="product-front">
                    <div class="shadow"></div>
                    <img src="{{ $productItem->feature_image_path }}" alt="" />
                    <div class="image_overlay"></div>
                    <div data-product-id="{{ $productItem->id }}" class="add_to_cart add-to-cart-btn">Add to cart</div>
                    <div class="view_gallery">View</div>
                    <div class="stats" >
                        <div class="stats-container" style="width: 100%;">
                            <span class="product_price">${{ $productItem->discounted_price }}</span>
                            <span class="product_name">{{ $productItem->name }}</span>
                            <p>{{ $productItem->description }}</p>
                            <div class="product-options">
                                <strong>SIZES</strong>
                                <span>{{ $productItem->sizes }}</span>
                                <strong>COLORS</strong>
                                <div class="colors">
                                    <div class="c-blue"><span></span></div>
                                    <div class="c-red"><span></span></div>
                                    <div class="c-white"><span></span></div>
                                    <div class="c-green"><span></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-back">
                    <div class="shadow"></div>
                    <div class="carousel">
                        <ul class="carousel-container">
                            @foreach( $productItem->images as $image )
                                <li><img src="{{ $image->image_path }}" alt="" /></li>
                            @endforeach
                        </ul>
                        <div class="arrows-perspective">
                            <div class="carouselPrev">
                                <div class="y"></div>
                                <div class="x"></div>
                            </div>
                            <div class="carouselNext">
                                <div class="y"></div>
                                <div class="x"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flip-back">
                        <div class="cy"></div>
                        <div class="cx"></div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(".add-to-cart-btn").click(function(){
        let productId =  $(this).data('product-id');

        $.ajax({
            url: '/add-to-cart',
            method: 'POST',
            data: {
                product_id: productId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#cart-quantity').text(response.totalItems);
            }
        });
    });
</script>
@endsection
