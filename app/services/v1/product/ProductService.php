<?php

namespace App\services\v1\product;

use App\services\v1\product\interfaces\ProductInterfaceService;

class ProductService implements ProductInterfaceService
{

    public function fetchProducts(int $perPage) {}

    public function fetchProductById(string $id) {}

    public function storeProduct($payload) {}

    public function editProduct(string $id, $data) {}

    public function removeProduct(string $id) {}
}
