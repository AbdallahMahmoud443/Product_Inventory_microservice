<?php

namespace App\Http\Controllers\v1\stock;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\stock\AdjustQuantityRequestValidation;
use App\Http\Responses\v1\MessageResponse;
use App\Models\Product;
use App\services\v1\stock\interfaces\StockInterfaceService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AdjustStockQuantityController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AdjustQuantityRequestValidation $request, string $id, StockInterfaceService $stockService)
    {
        $adjustment  = (int) $request->adjustment;
        $product = $stockService->adjustStockQuantity($adjustment, $id);
        return new MessageResponse(
            message: 'Stock quantity adjusted successfully',
            data: $product,
            statusCode: Response::HTTP_OK
        );
    }
}
