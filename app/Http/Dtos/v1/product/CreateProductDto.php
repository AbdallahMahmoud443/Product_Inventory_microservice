<?php

namespace App\Http\Dtos\v1\product;


readonly class CreateProductDto
{
    public string $sku;
    public string $name;
    public ?string $description;
    public float $price;
    public float $stock_quantity;
    public int $low_stock_threshold;
    public string $status;

    public static function fromRequest(array $data): self
    {
        return new self([
            'sku' => $data['sku'],
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'price' => (float) $data['price'],
            'stock_quantity' => (float) $data['stock_quantity'],
            'low_stock_threshold' => (int) ($data['low_stock_threshold'] ?? 10),
            'status' => $data['status'] ?? 'active',
        ]);
    }
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'sku' => $this->sku,
            'description' => $this->description,
            'price' => $this->price,
            'stock_quantity' => $this->stock_quantity,
            'low_stock_threshold' => $this->low_stock_threshold,
            'status' => $this->status,
        ];
    }
}
