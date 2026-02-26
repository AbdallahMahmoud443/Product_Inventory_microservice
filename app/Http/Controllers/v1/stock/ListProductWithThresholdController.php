<?php

namespace App\Http\Controllers\v1\stock;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\product\ProductsResource;
use App\Models\Product;
use App\services\v1\stock\interfaces\StockInterfaceService;
use Illuminate\Http\Request;

class ListProductWithThresholdController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StockInterfaceService $stockService)
    {
        return ProductsResource::collection($stockService->fetchProductWithQuantityLowThreshold());
    }
}
