<?php

namespace App\Http\Controllers\v1\stock;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdjustStockQuantityController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $id)
    {
        $request->validate([
            'adjustment' => 'required|integer ',
        ], [
            'adjustment.required' => 'Stock quantity is required',
            'adjustment.numeric' => 'Stock quantity must be a integer '
        ]);
        $adjustment  = $request->stock_quantity;
        // TODO: Adjust stock quantity
        return DB::transaction(function () use ($id, $adjustment) {
            $product = Product::where('id', $id)
                ->lockForUpdate()
                ->firstOrFail();
            $stock_quantity = (int)  $product->stock_quantity;
            if ($stock_quantity <= 0) {
                throw new Exception('stock quantity is not available');
            } else if ($adjustment  > 0 && ($adjustment  > $stock_quantity || $adjustment  < $stock_quantity)) {
                $product->stock_quantity += $adjustment;
            } elseif ($adjustment  < 0 && abs($adjustment) <= $stock_quantity) {
                $product->stock_quantity = $product->stock_quantity - abs($adjustment);
            } elseif ($adjustment  < 0 && abs($adjustment) > $stock_quantity) {
                throw new Exception('Required quantity is not available, product Quantity is ' . $stock_quantity);
            } else {
                throw new Exception('stock quantity is not available');
            }
            $product->save();
            return response()->json([
                'message' => 'Stock quantity adjusted successfully',
                'data' => $product
            ], 200);
        });
    }
}
