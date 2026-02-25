<?php

declare(strict_types=1);

namespace App\services\v1\product;

use App\repositories\v1\product\interfaces\ProductInterfaceRepository;
use App\services\v1\product\interfaces\ProductInterfaceService;
use Illuminate\Support\Facades\Cache;

class ProductService implements ProductInterfaceService
{
    function __construct(private readonly ProductInterfaceRepository $productRepository) {}
    public function fetchProducts()
    {
        $products = Cache::remember("products", 60 * 60, function () {
            return $this->productRepository->getProducts();
        });
        return $products;
    }

    public function fetchProductById(string $id)
    {
        return $this->productRepository->getProductById(id: $id);
    }

    public function storeProduct($payload)
    {
        return $this->productRepository->createProduct(data: $payload);
    }

    public function editProduct(string $id, $payload)
    {
        return $this->productRepository->updateProduct(id: $id, data: $payload);
    }

    public function removeProduct(string $id)
    {
        return $this->productRepository->deleteProduct(id: $id);
    }
}
