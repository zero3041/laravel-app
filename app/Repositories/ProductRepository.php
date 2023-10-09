<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function findById($id)
    {
        return Product::find($id);
    }

    public function getAllProducts()
    {
        return Product::paginate(12);
    }

    public function searchProducts($query)
    {
        return Product::where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->paginate(12);
    }

    public function sortProducts($sortBy)
    {
        $query = Product::query();
        switch ($sortBy) {
            case 'name':
                $query->orderBy('name');
                break;
            case 'discounted_price':
                $query->orderBy('discounted_price');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }
        return $query->paginate(12);
    }
}
