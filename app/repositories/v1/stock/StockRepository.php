<?php

namespace App\repositories\v1\stock;

use App\Models\Product;
use App\repositories\v1\stock\interfaces\StockInterfaceRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class StockRepository implements StockInterfaceRepository
{


    public function adjustStockQuantity(int $adjustment, Product $product): Product
    {
        return  DB::transaction(function () use ($product, $adjustment) {
            $product->lockForUpdate();
            $product->stock_quantity = $adjustment;
            $product->save();
            return $product;
        });
    }

    public function getProductWithQuantityLowThreshold(): LengthAwarePaginator
    {
        return Product::whereColumn('stock_quantity', '<', 'low_stock_threshold')
            ->paginate(10);
    }
}
