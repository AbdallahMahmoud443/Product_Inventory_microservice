<?php

namespace App\Http\Controllers\v1\stock;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ListProductWithThresholdController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        return Product::whereColumn('stock_quantity', '<', 'low_stock_threshold')->get();
    }
}
