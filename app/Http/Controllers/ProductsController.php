<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
//Hello World
class ProductsController extends Controller
{
    public function index(Request $request){
        $cart = session('cart', []);
        $product_cart = Product::whereIn('id', array_keys($cart))->get();
        if ($request->has('query')) {
            $query = $request->input('query');
            $products = Product::where('name', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->paginate(12);
        } else {
            $products = Product::paginate(12);
        }

        if ($request->has('sort_by')) {
            $query = Product::query();
            switch ($request->sort_by) {
                case 'name':
                    $query->orderBy('name');
                    break;
                case 'discounted_price':
                    $query->orderBy('discounted_price');
                    break;
                default:
                    // Sắp xếp mặc định nếu cần
                    $query->orderBy('created_at', 'desc');
            }
            $products = $query->paginate(12)->appends(['sort_by' => $request->sort_by]);
//            dd($query);
        }

//        $products = ['products'=> $products];

//        session()->flush();
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

        // Giả sử bạn có hàm getProductDetails() để lấy chi tiết sản phẩm
        $productDetails = $this->getProductDetails($productId);

        // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Nếu sản phẩm chưa tồn tại, thêm mới
            $productDetails['quantity'] = $quantity;
            $cart[$productId] = $productDetails;
        }

        session()->put('cart', $cart);

        return response()->json(['status' => 'success']);
    }
    public function getProductDetails($productId) {
        $product = Product::find($productId);

        return $product ? [
            'name' => $product->name,
            'price' => $product->price,
            'feature_image_path' => $product->feature_image_path,
        ] : [];
    }



    public function detail($id){
        $product = Product::find($id);
        return view('products.detail',compact('product'));
    }
}
