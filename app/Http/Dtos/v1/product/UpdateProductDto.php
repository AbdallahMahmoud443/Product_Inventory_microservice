<?php

namespace App\Http\Dtos\v1\product;

readonly class UpdateProductDto
{
    public ?string $name;
    public ?string $sku;
    public ?string $description;
    public ?float $price;
    public ?float $stock_quantity;
    public ?int $low_stock_threshold;
    public ?string $status;

    public static function fromRequest(array $data): self
    {
        return new self([
            'name' => $data['name'] ?? null,
            'sku' => $data['sku'] ?? null,
            'description' => $data['description'] ?? null,
            'price' => isset($data['price']) ? (float) $data['price'] : null,
            'stock_quantity' => isset($data['stock_quantity']) ? (float) $data['stock_quantity'] : null,
            'low_stock_threshold' => isset($data['low_stock_threshold']) ? (int) $data['low_stock_threshold'] : null,
            'status' => $data['status'] ?? null,
        ]);
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'sku' => $this->sku,
            'description' => $this->description,
            'price' => $this->price,
            'stock_quantity' => $this->stock_quantity,
            'low_stock_threshold' => $this->low_stock_threshold,
            'status' => $this->status,
        ], function ($value) {
            return $value !== null;
        });
    }
}
