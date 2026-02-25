<?php

namespace App\Http\Controllers\v1\product;

use App\Http\Controllers\Controller;

use App\Http\Resources\v1\product\ProductsResource;
use App\services\v1\product\ProductService;


class ListProductsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ProductService $productService)
    {
        $productions = $productService->fetchProducts();

        return ProductsResource::collection(resource: $productions);
    }
}
