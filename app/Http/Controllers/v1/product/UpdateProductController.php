<?php

namespace App\Http\Controllers\v1\product;

use App\Http\Controllers\Controller;
use App\Http\Dtos\v1\product\UpdateProductDto;
use App\Http\Requests\v1\product\UpdateProductRequest;
use App\Http\Responses\v1\MessageResponse;
use App\services\v1\product\interfaces\ProductInterfaceService;
use Illuminate\Http\Response;

class UpdateProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateProductRequest $request, string $id, ProductInterfaceService $productService)
    {
        $updateProductDto = UpdateProductDto::fromRequest($request->validated());
        $updateProduct = $productService->editProduct($id, $updateProductDto);
        return new MessageResponse(
            message: 'Product Updated successfully',
            data: $updateProduct,
            statusCode: Response::HTTP_OK,
        );
    }
}
