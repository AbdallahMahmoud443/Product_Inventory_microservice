<?php

namespace App\Http\Controllers\v1\product;

use App\Http\Controllers\Controller;
use App\Http\Responses\v1\MessageResponse;
use App\services\v1\product\interfaces\ProductInterfaceService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SoftDeleteProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $id, ProductInterfaceService $productService)
    {
        $isDeleted = $productService->removeProduct($id);
        if ($isDeleted)
            return new MessageResponse(
                message: 'Product Delete successfully',
                statusCode: Response::HTTP_OK,
            );
    }
}
