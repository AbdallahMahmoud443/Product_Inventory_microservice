<?php

namespace App\repositories\v1\stock\interfaces;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

interface StockInterfaceRepository
{
    /**
     * Adjust the stock quantity of a product (For Repo)
     *
     * @param int $adjustment The amount to adjust the stock by (positive or negative)
     * @param Product $product The product model to adjust the stock
     * @return Product The updated product model
     */
    public function adjustStockQuantity(int $adjustment, Product $product): Product;
    /**
     * Get products that have reached their low stock threshold (For Repo)
     *
     * @return LengthAwarePaginator Paginated list of products with low stock
     */
    public function getProductWithQuantityLowThreshold(): LengthAwarePaginator;
}
