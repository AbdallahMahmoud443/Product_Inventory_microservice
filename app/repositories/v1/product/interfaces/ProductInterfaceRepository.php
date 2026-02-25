<?php

namespace App\repositories\v1\product\interfaces;

interface ProductInterfaceRepository
{
    /**
     * Get all products from the database.(For Repo Scope)
     * @param int $perPage The number of product per Page
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getProducts(int $perPage);
    /**
     * Get a specific product by its ID.(For Repo Scope)
     *
     * @param string $id The UUID of the product
     * @return \App\Models\Product|null
     */
    public function getProductById(string $id);

    /**
     * Create a new product in the database.(For Repo Scope)
     *
     * @param array $data The product data including:
     *                    - sku: string (required)
     *                    - name: string (required)
     *                    - description: string (optional)
     *                    - price: float (required)
     *                    - stock_quantity: float (required)
     *                    - low_stock_threshold: int (optional)
     *                    - status: string (required)
     * @return \App\Models\Product
     */
    public function createProduct($data);

    /**
     * Update an existing product.(For Repo Scope)
     *
     * @param string $id The UUID of the product to update
     * @param array $data The product data to update (same structure as createProduct)
     * @return \App\Models\Product|null
     */
    public function updateProduct(string $id, $data);

    /**
     * Delete a product from the database.(For Repo Scope)
     *
     * @param string $id The UUID of the product to delete
     * @return bool True if deletion was successful, false otherwise
     */
    public function deleteProduct(string $id);
}
