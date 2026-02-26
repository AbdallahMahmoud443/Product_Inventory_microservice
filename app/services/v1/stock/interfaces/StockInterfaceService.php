<?php

namespace App\services\v1\stock\interfaces;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

interface StockInterfaceService
{
    /**
     * Adjust the stock quantity of a product (For Service)
     *
     * @param int $adjustment The amount to adjust the stock by (positive or negative)
     * @param string $id The ID of the product to adjust
     * @return Product The updated product model
     */
    public function adjustStockQuantity(int $adjustment, string $id): Product;
    /**
     * Get products that have reached their low stock threshold (For Service)
     *
     * @return LengthAwarePaginator Paginated list of products with low stock
     */
    public function fetchProductWithQuantityLowThreshold(): LengthAwarePaginator;
}
