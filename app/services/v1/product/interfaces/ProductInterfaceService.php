<?php

namespace App\services\v1\product\interfaces;

interface ProductInterfaceService
{
    /**
     * Fetch all products from the database.(For Service Scope)
     * @param int $perPage The number of product per Page
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetchProducts(int $perPage);
    /**
     * Fetch a specific product by its ID.(For Service Scope)
     *
     * @param string $id The UUID of the product
     * @return \App\Models\Product|null
     */
    public function fetchProductById(string $id);

    /**
     * Store a new product in the database.(For Service Scope)
     *
     * @param array $payload The product data including:
     *                    - sku: string (required)
     *                    - name: string (required)
     *                    - description: string (optional)
     *                    - price: float (required)
     *                    - stock_quantity: float (required)
     *                    - low_stock_threshold: int (optional)
     *                    - status: string (required)
     * @return \App\Models\Product
     */
    public function storeProduct($payload);

    /**
     * Edit an existing product.(For Service Scope)
     *
     * @param string $id The UUID of the product to update
     * @param array $data The product data to update (same structure as createProduct)
     * @return \App\Models\Product|null
     */
    public function editProduct(string $id, $data);

    /**
     * Remove a product from the database.(For Service Scope)
     *
     * @param string $id The UUID of the product to delete
     * @return bool True if deletion was successful, false otherwise
     */
    public function removeProduct(string $id);
}
