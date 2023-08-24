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
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

//        session()->flush();
//        dd(session('cart'));

        return response()->json(['totalItems' => count($cart)]);
    }

    public function detail(){
        return view('products.detail');
    }
}
