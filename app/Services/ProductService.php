<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProductDetails($productId)
    {
        return $this->productRepository->findById($productId);
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAllProducts();
    }

    public function searchProducts($query)
    {
        return $this->productRepository->searchProducts($query);
    }

    public function sortProducts($sortBy)
    {
        return $this->productRepository->sortProducts($sortBy);
    }
}
