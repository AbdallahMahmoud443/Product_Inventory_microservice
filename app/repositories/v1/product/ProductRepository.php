<?php

declare(strict_types=1);

namespace App\repositories\v1\product;

use App\Http\Dtos\v1\product\CreateProductDto;
use App\Http\Dtos\v1\product\UpdateProductDto;
use App\Models\Product;
use App\repositories\v1\product\interfaces\ProductInterfaceRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductInterfaceRepository
{

    public function __construct(public Product $product) {}

    public function getProducts(): LengthAwarePaginator
    {
        return $this->product->query()->Paginate(10);
    }

    public function getProductById(string $id): Product
    {
        return $this->product->query()->findOrFail($id);
    }

    public function createProduct(CreateProductDto $data): Product
    {
        return $this->product->query()->create($data->toArray());
    }

    public function updateProduct(string $id, UpdateProductDto $data): Product
    {
        $product = $this->getProductById($id);
        $product->update($data->toArray());
        return $product;
    }

    public function deleteProduct(string $id): bool
    {
        $product = $this->getProductById($id);
        return  $product->delete();
    }
}
