<?php

declare(strict_types=1);

namespace App\repositories\v1\product\interfaces;

use App\Http\Dtos\v1\product\CreateProductDto;
use App\Http\Dtos\v1\product\UpdateProductDto;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductInterfaceRepository
{
    /**
     * Get all products from the database.(For Repo Scope)
     * @return LengthAwarePaginator
     */
    public function getProducts(): LengthAwarePaginator;
    /**
     * Get a specific product by its ID.(For Repo Scope)
     *
     * @param string $id The UUID of the product
     * @return \App\Models\Product|null
     */
    public function getProductById(string $id): Product;

    /**
     * Create a new product in the database.(For Repo Scope)
     *
     * @param CreateProductDto $data The product data including:
     *                    - sku: string (required)
     *                    - name: string (required)
     *                    - description: string (optional)
     *                    - price: float (required)
     *                    - stock_quantity: float (required)
     *                    - low_stock_threshold: int (optional)
     *                    - status: string (required)
     * @return \App\Models\Product
     */
    public function createProduct(CreateProductDto $data): Product;

    /**
     * Update an existing product.(For Repo Scope)
     *
     * @param string $id The UUID of the product to update
     * @param UpdateProductDto $data The product data to update (same structure as createProduct)
     * @return \App\Models\Product|null
     */
    public function updateProduct(string $id, UpdateProductDto $data): Product;

    /**
     * Delete a product from the database.(For Repo Scope)
     *
     * @param string $id The UUID of the product to delete
     * @return bool True if deletion was successful, false otherwise
     */
    public function deleteProduct(string $id): bool;
}
