<?php

namespace App\Http\Controllers\v1\product;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\product\ProductsResource;
use App\services\v1\product\ProductService;
use Illuminate\Http\Request;

class GetProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ProductService $productService, string $id)
    {
        //
        $product = $productService->fetchProductById(id: $id);
        return ProductsResource::make($product);
    }
}
