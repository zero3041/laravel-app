@extends('layouts.admin')

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style_index_admin.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    @include('admin.partials.content-header',['name' => 'Product','key' => 'List'])
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('product.create') }}"class="btn btn-success float-right m-2">Add</a>
                <button id="delete-selected" class="btn btn-danger">Xoá nhiều sản phẩm</button>

            </div>


        </div>
      </div>
    </div>
    <div id="grid" style="padding-left: 170px !important;
    width: 100% !important;
    position: inherit !important;
    left: 340px !important;
    height: 1200px !important;
    top: 180px !important;
    ">
        @foreach( $products as $productItem )
        <div class="product">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="product-checkbox" value="{{ $productItem->id }}">
            </div>
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
                    <a href="{{ route('product.edit',['id'=>$productItem->id]) }}"><div class="add_to_cart">Edit</div></a>
                    <a href="" class="delete-product" data-id="{{ $productItem->id }}"><div class="add_to_cart_delete">Delete</div></a>
                    <div class="view_gallery">View</div>
                    <div class="stats" style="width: 100% !important;">
                        <div class="stats-container" style="width: 100% !important;">
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
    <div class="col-md-12">
                {{$products->links('pagination::bootstrap-4')}}
            </div>
</div>

@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#delete-selected').on('click', function() {
            let selectedProducts = [];

            $('.product-checkbox:checked').each(function() {
                selectedProducts.push($(this).val());
            });

            if (selectedProducts.length === 0) {
                alert('Vui lòng chọn ít nhất 1 sản phẩm');
                return;
            }

            if (confirm('Bạn có chắc chắn sẽ xoá sản phẩm này chứ?')) {
                $.ajax({
                    url: "{{ route('product.deleteMultiple') }}",
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "products": selectedProducts
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(err) {
                        alert('Có lỗi khi xoá. Vui lòng thử lại');
                    }
                });
            }
        });
    </script>
{{--    xoa 1 san pham--}}
    <script>
        $(document).on('click', '.delete-product', function(e) {
            e.preventDefault();

            let productId = $(this).data('id');

            if (confirm('Bạn có muốn xoá sản phẩm này không?')) {
                $.ajax({
                    url: `/admins/product/delete/${productId}`,
                    method: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if(response.success) {
                            alert(response.message);
                            location.reload();
                        } else {
                            alert('Có lỗi khi xoá. Vui lòng thử lại');
                        }
                    },
                    error: function(err) {
                        alert('Có lỗi khi xoá. Vui lòng thử lại');
                    }
                });
            }
        });
    </script>


@endsection
