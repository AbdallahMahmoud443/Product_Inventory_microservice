<?php

namespace App\services\v1\stock;

use App\Events\v1\stock\ProductWithLowThresholdEvent;
use App\Models\Product;
use App\repositories\v1\product\interfaces\ProductInterfaceRepository;
use App\repositories\v1\stock\interfaces\StockInterfaceRepository;
use App\services\v1\stock\interfaces\StockInterfaceService;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class StockService implements StockInterfaceService
{
    function __construct(private readonly StockInterfaceRepository $StockRepo, private readonly ProductInterfaceRepository $productRepo) {}

    public function adjustStockQuantity(int $adjustment, string $id): Product
    {
        $product = $this->productRepo->getProductById($id);

        $stock_quantity = (int)  $product->stock_quantity;
        if ($stock_quantity <= 0 && $adjustment <= 0) {
            throw new Exception('stock quantity is not available');
        } else if ($adjustment  > 0) {
            $adjustment = $adjustment + $product->stock_quantity;
        } elseif ($adjustment  < 0 && abs($adjustment) <= $stock_quantity) {
            $adjustment = $product->stock_quantity - abs($adjustment);
        } elseif ($adjustment  < 0 && abs($adjustment) > $stock_quantity) {
            throw new Exception('Required quantity is not available, product Quantity is ' . $stock_quantity);
        } else {
            throw new Exception('stock quantity is not available');
        }
        $newProduct = $this->StockRepo->adjustStockQuantity($adjustment, $product);
        if ($newProduct->low_stock_threshold > $newProduct->stock_quantity) {
            event(new ProductWithLowThresholdEvent($newProduct));
        }
        return $newProduct;
    }

    public function fetchProductWithQuantityLowThreshold(): LengthAwarePaginator
    {
        return $this->StockRepo->getProductWithQuantityLowThreshold();
    }
}
