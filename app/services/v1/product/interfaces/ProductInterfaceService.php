<?php

declare(strict_types=1);

namespace App\services\v1\product\interfaces;

use App\Http\Dtos\v1\product\CreateProductDto;
use App\Http\Dtos\v1\product\UpdateProductDto;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductInterfaceService
{
    /**
     * Fetch all products from the database.(For Service Scope)
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetchProducts(): LengthAwarePaginator;
    /**
     * Fetch a specific product by its ID.(For Service Scope)
     *
     * @param string $id The UUID of the product
     * @return \App\Models\Product|null
     */
    public function fetchProductById(string $id): Product;

    /**
     * Store a new product in the database.(For Service Scope)
     *
     * @param CreateProductDto $payload The product data including:
     *                    - sku: string (required)
     *                    - name: string (required)
     *                    - description: string (optional)
     *                    - price: float (required)
     *                    - stock_quantity: float (required)
     *                    - low_stock_threshold: int (optional)
     *                    - status: string (required)
     * @return \App\Models\Product
     */
    public function storeProduct(CreateProductDto $payload): Product;

    /**
     * Edit an existing product.(For Service Scope)
     *
     * @param string $id The UUID of the product to update
     * @param UpdateProductDto $data The product data to update (same structure as createProduct)
     * @return \App\Models\Product|null
     */
    public function editProduct(string $id, UpdateProductDto $data): Product;

    /**
     * Remove a product from the database.(For Service Scope)
     *
     * @param string $id The UUID of the product to delete
     * @return bool True if deletion was successful, false otherwise
     */
    public function removeProduct(string $id): bool;
}
