<div id="sidebar">
    <a style="text-decoration: none" href="/cart">
        <h3>CART<span id="cart-quantity" style="margin-left: 30px;
                                                    color: red;">
                    {{ session('cart') ? count(session('cart')) : 0 }}
                    </span></h3>

    </a>

{{--    <div id="cart">--}}
{{--        <span class="empty">No items in cart.</span>--}}
{{--    </div>--}}

    @if( session('cart') !== null)
        <div id="cart">
            <span class="empty" style="display: none;">No items in cart.</span>
            @foreach( $product_cart as $product_cartItem )
                <div class="cart-item">
                    <div class="img-wrap"><img src="{{ $product_cartItem->feature_image_path }}" alt=""></div>
                    <span>{{ $product_cartItem->name }}</span><strong>${{ $product_cartItem->discounted_price }}</strong>
                    <div class="cart-item-border"></div>
                    <div class="delete-item"></div>
                </div>
            @endforeach
        </div>
    @else
        <div id="cart">
            <span class="empty">No items in cart.</span>
        </div>
    @endif

    <h3>CATEGORIES</h3>
    <div class="checklist categories">
        <ul>
            <li><a href=""><span></span>New Arivals</a></li>
            <li><a href=""><span></span>Accesories</a></li>
            <li><a href=""><span></span>Bags</a></li>
            <li><a href=""><span></span>Dressed</a></li>
            <li><a href=""><span></span>Jackets</a></li>
            <li><a href=""><span></span>jewelry</a></li>
            <li><a href=""><span></span>Shoes</a></li>
            <li><a href=""><span></span>Shirts</a></li>
            <li><a href=""><span></span>Sweaters</a></li>
            <li><a href=""><span></span>T-shirts</a></li>
        </ul>
    </div>

    <h3>COLORS</h3>
    <div class="checklist colors">
        <ul>
            <li><a href=""><span></span>Beige</a></li>
            <li><a href=""><span style="background:#222"></span>Black</a></li>
            <li><a href=""><span style="background:#6e8cd5"></span>Blue</a></li>
            <li><a href=""><span style="background:#f56060"></span>Brown</a></li>
            <li><a href=""><span style="background:#44c28d"></span>Green</a></li>
        </ul>

        <ul>
            <li><a href=""><span style="background:#999"></span>Grey</a></li>
            <li><a href=""><span style="background:#f79858"></span>Orange</a></li>
            <li><a href=""><span style="background:#b27ef8"></span>Purple</a></li>
            <li><a href=""><span style="background:#f56060"></span>Red</a></li>
            <li><a href=""><span style="background:#fff;border: 1px solid #e8e9eb;width:13px;height:13px;"></span>White</a>
            </li>
        </ul>
    </div>

    <h3>SIZES</h3>
    <div class="checklist sizes">
        <ul>
            <li><a href=""><span></span>XS</a></li>
            <li><a href=""><span></span>S</a></li>
            <li><a href=""><span></span>M</a></li>
        </ul>

        <ul>
            <li><a href=""><span></span>L</a></li>
            <li><a href=""><span></span>XL</a></li>
            <li><a href=""><span></span>XXL</a></li>
        </ul>
    </div>

    <h3>PRICE RANGE</h3>
    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/price-range.png" alt=""/>
</div>
<div id="grid-selector">
    <div id="grid-menu">
        View:
        <ul>
            <li class="largeGrid"><a href=""></a></li>
            <li class="smallGrid"><a class="active" href=""></a></li>
        </ul>
    </div>

    Showing 1-12 of {{ \App\Models\Product::count() }} results
</div>
