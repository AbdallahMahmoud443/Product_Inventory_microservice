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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class ProductService implements ProductInterfaceService
{
    function __construct(private readonly ProductInterfaceRepository $productRepository) {}
    public function fetchProducts(): LengthAwarePaginator
    {
        $page = request('page', 1);
        $requestedPerPage = (int) request('per_page', 15);
        $allowedPerPage = config('pagination.allowed_per_page');
        $perPage = in_array($requestedPerPage, $allowedPerPage)
            ? $requestedPerPage
            : config('pagination.default_per_page');

        $cacheKey = "products:page={$page}:perPage={$perPage}";
        $products = Cache::tags(['products'])->remember(
            $cacheKey,
            now()->addMinutes(10),
            function () {
                Log::info('Fetching products from database');
                return $this->productRepository->getProducts();
                return Product::orderBy('created_at', 'desc')->paginate(15);
            }
        );
        return $products;
    }

    public function fetchProductById(string $id): Product
    {
        return $this->productRepository->getProductById(id: $id);
    }

    public function storeProduct(CreateProductDto $payload): Product
    {
        return $this->productRepository->createProduct(data: $payload);
    }

    public function editProduct(string $id, UpdateProductDto $payload): Product
    {
        return $this->productRepository->updateProduct(id: $id, data: $payload);
    }

    public function removeProduct(string $id): bool
    {
        return $this->productRepository->deleteProduct(id: $id);
    }
}
