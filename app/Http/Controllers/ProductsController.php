<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
//Hello World
class ProductsController extends Controller
{
    public function index(){
        $products = Product::paginate(12);
        $cart = session('cart', []);
        $product_cart = Product::whereIn('id', array_keys($cart))->get();
        return view('products.index',compact('products','product_cart'));
    }

    public function add(Request $request)
    {
        $product = Product::find($request->product_id);
        $cart = session()->get('cart', []);
//        dd($product);
        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] += 1;
        } else {
            $cart[$request->product_id] = [
                'name' => $product->name,
                'price' => $product->discounted_price,
                'quantity' => 1,
                'feature_image_path' => $product->feature_image_path
            ];
        }

        session()->put('cart', $cart);

//        session()->flush();
//        dd(session('cart'));

        return response()->json(['totalItems' => count($cart)]);
    }
    public function addToCart(Request $request) {
        $cart = session()->get('cart', []);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            // Nếu sản phẩm chưa tồn tại, thêm mới
            $cart[$productId] = $quantity;
        }

        session()->put('cart', $cart);

        return response()->json(['status' => 'success']);
    }


    public function detail($id){
        $product = Product::find($id);
        return view('products.detail',compact('product'));
    }
}
