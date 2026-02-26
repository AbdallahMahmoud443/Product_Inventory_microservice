<?php

namespace App\Http\Dtos\v1\product;

readonly class UpdateProductDto
{

    public function __construct(
        public ?string $name,
        public ?string $sku,
        public ?string $description,
        public ?float $price,
        public ?int $low_stock_threshold,
        public ?string $status,
    ) {}
    public static function fromRequest(array $data): self
    {

        return new self(
            $data['name'] ?? null,
            $data['sku'] ?? null,
            $data['description'] ?? null,
            isset($data['price']) ? (float) $data['price'] : null,
            isset($data['low_stock_threshold']) ? (int) $data['low_stock_threshold'] : null,
            $data['status'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'sku' => $this->sku,
            'description' => $this->description,
            'price' => $this->price,
            'low_stock_threshold' => $this->low_stock_threshold,
            'status' => $this->status,
        ], function ($value) {
            return $value !== null;
        });
    }
}
