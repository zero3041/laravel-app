@extends('layouts.app')

@section('content')
    <div class="small-container cart-page">
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            @php
                $subtotal = 0;
            @endphp
            @foreach( $cart as $productId => $productDetails)
                @php
                    $productTotal = $productDetails['price'] * $productDetails['quantity'];
                    $subtotal += $productTotal;
                @endphp
                <tr>
                    <td>
                        <div class="cart-info">
                            <img src="{{ $productDetails['feature_image_path'] }}" alt="">
                            <div>
                                <p>{{ $productDetails['name'] }}</p>
                                <small>Price: {{ number_format($productDetails['price']) }} $</small>
                                <br>
                                <a href="" data-product-id="{{ $productId }}" class="remove-from-cart-btn">Remove</a>
                            </div>
                        </div>
                    </td>
                    <td> <input type="number" value="{{ $productDetails['quantity'] }}"> </td>
                    <td>{{ number_format($productTotal) }} đ</td>
                </tr>
            @endforeach
        </table>

        @php
            $tax = $subtotal * 0.1;  // giả sử thuế là 20%
            $total = $subtotal + $tax;
        @endphp

        <div class="total-price">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>{{ number_format($subtotal) }} $</td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>{{ number_format($tax) }} $</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>{{ number_format($total) }} $</td>
                </tr>
            </table>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).on('click', '.remove-from-cart-btn', function(e) {
            e.preventDefault();

            let productId = $(this).data('product-id');

            $.ajax({
                url: '/remove-from-cart',
                method: 'POST',
                data: {
                    product_id: productId,
                    _token: "{{ csrf_token() }}"  // Đảm bảo bạn đã thêm token CSRF cho bảo mật
                },
                success: function(response) {
                    if (response.status === 'success') {
                        // Xóa sản phẩm khỏi giao diện hoặc làm mới trang
                        location.reload();
                    }
                }
            });
        });

    </script>
@endsection
