<?php

namespace App\Http\Dtos\v1\product;


class CreateProductDto
{

    public function __construct(
        public string $sku,
        public string $name,
        public ?string $description,
        public float $price,
        public float $stock_quantity,
        public int $low_stock_threshold,
        public string $status,
    ) {}
    public static function fromRequest(array $data): self
    {
        return new self(
            $data['sku'],
            $data['name'],
            $data['description'] ?? null,
            (float) $data['price'],
            (float) $data['stock_quantity'],
            (int) ($data['low_stock_threshold'] ?? 10),
            $data['status'] ?? 'active',
        );
    }
    public function toArray(): array
    {
        return [
            'sku' => $this->sku,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock_quantity' => $this->stock_quantity,
            'low_stock_threshold' => $this->low_stock_threshold,
            'status' => $this->status,
        ];
    }
}
