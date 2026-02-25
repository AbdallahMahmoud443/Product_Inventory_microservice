<?php

declare(strict_types=1);

namespace App\repositories\v1\product;

use App\Models\Product;
use App\repositories\v1\product\interfaces\ProductInterfaceRepository;

class ProductRepository implements ProductInterfaceRepository
{

    public function __construct(public Product $product) {}

    public function getProducts()
    {
        return $this->product->query()->Paginate(10);
    }

    public function getProductById(string $id)
    {
        return $this->product->query()->findOrFail($id);
    }

    public function createProduct($data)
    {
        return $this->product->query()->create($data);
    }

    public function updateProduct(string $id, $data)
    {
        return $this->product->query()->where('id', $id)->update($data);
    }

    public function deleteProduct(string $id)
    {
        return $this->product->query()->where('id', $id)->delete();
    }
}
