<div class="headers">
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
                        <li><a href="">{{ Auth::guard('web')->user()->username }}</a></li>
                        <li><a href="{{ route('logout') }}">Logout</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Account</a></li>
                    @endif
                </ul>
            </nav>
            <a href="cart.html"><img src="images/cart.png" width="30px" height="30px" alt=""></a>
            <img src="images/menu.png" onclick="menutoggle()" class="menu-icon">
        </div>
    </div>
</div>
