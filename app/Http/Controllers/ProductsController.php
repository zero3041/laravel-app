<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $cart = session('cart', []);
        $product_cart = $this->productService->getProductDetails(array_keys($cart));

        if ($request->has('query')) {
            $query = $request->input('query');
            $products = $this->productService->searchProducts($query);
        } else {
            $products = $this->productService->getAllProducts();
        }

        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by');
            $products = $this->productService->sortProducts($sortBy);
        }

        return view('products.index', compact('products', 'product_cart'));
    }

    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Đảm bảo $productId và $quantity là hợp lệ

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $productDetails = $this->productService->getProductDetails($productId);

            if (!$productDetails) {
                return response()->json(['error' => 'Product not found'], 404);
            }

            $cart[$productId] = [
                'name' => $productDetails->name,
                'price' => $productDetails->discounted_price,
                'quantity' => $quantity,
                'feature_image_path' => $productDetails->feature_image_path,
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['totalItems' => count($cart)]);
    }

    public function detail($id)
    {
        $product = $this->productService->getProductDetails($id);

        if (!$product) {
            return abort(404);
        }

        return view('products.detail', compact('product'));
    }

    public function add_product(Request $request)
    {
        //
    }
}
