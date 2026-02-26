<?php

declare(strict_types=1);

namespace App\services\v1\product;

use App\Http\Dtos\v1\product\CreateProductDto;
use App\Http\Dtos\v1\product\UpdateProductDto;
use App\Models\Product;
use App\repositories\v1\product\interfaces\ProductInterfaceRepository;
use App\services\v1\product\interfaces\ProductInterfaceService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class ProductService implements ProductInterfaceService
{
    function __construct(private readonly ProductInterfaceRepository $productRepository) {}
    public function fetchProducts(): LengthAwarePaginator
    {
        $products = Cache::remember("products", 60 * 60, function () {
            return $this->productRepository->getProducts();
        });
        return $products;
    }

    public function fetchProductById(string $id): Product
    {
        return $this->productRepository->getProductById(id: $id);
    }

    public function storeProduct(CreateProductDto $payload): Product
    {
        if (Cache::has("products")) {
            Cache::forget("products");
        }
        return $this->productRepository->createProduct(data: $payload);
    }

    public function editProduct(string $id, UpdateProductDto $payload): Product
    {
        if (Cache::has("products")) {
            Cache::forget("products");
        }
        return $this->productRepository->updateProduct(id: $id, data: $payload);
    }

    public function removeProduct(string $id): bool
    {
        if (Cache::has("products")) {
            Cache::forget("products");
        }
        return $this->productRepository->deleteProduct(id: $id);
    }
}
