<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $cart = session()->get('cart', []);
        return view('cart', ['cart' => $cart]);
    }

    public function removeFromCart(Request $request) {
        $productId = $request->input('product_id');

        $cart = session()->get('cart', []);

        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
        if (isset($cart[$productId])) {
            unset($cart[$productId]); // Xóa sản phẩm khỏi giỏ hàng
            session()->put('cart', $cart); // Cập nhật giỏ hàng trong session
        }

        return response()->json(['status' => 'success']);
    }

}
