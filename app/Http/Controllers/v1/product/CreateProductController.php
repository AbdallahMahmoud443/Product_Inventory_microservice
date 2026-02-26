<?php

namespace App\Http\Controllers\v1\product;

use App\Http\Controllers\Controller;
use App\Http\Dtos\v1\product\CreateProductDto;
use App\Http\Requests\v1\product\CreateProductRequest;
use App\Http\Responses\v1\MessageResponse;
use App\services\v1\product\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CreateProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateProductRequest $request, ProductService $productService)
    {
        $createProductDto = CreateProductDto::fromRequest($request->validated());
        $newProduct = $productService->storeProduct($createProductDto);
        return new MessageResponse(
            message: 'Product created successfully',
            data: $newProduct,
            statusCode: Response::HTTP_CREATED,
        );
    }
}
