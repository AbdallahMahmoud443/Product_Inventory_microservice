<?php

namespace Tests\Feature\product;

use App\Models\Product;
use Tests\TestCase;

class UpdateProductTest extends TestCase
{
    public function testUpdateProductWithInvalidPayload()
    {
        $product = Product::factory()->create();
        $response = $this->putJson(
            '/api/v1/products/' . $product->id,
            [
                "sku" => "PRD-001",
                "name" => "Sample Product",
                "description" => "This is a sample product description",
                "price" => "99.99",
                "stock_quantity" => 8,
                "low_stock_threshold" => 10,
                "status" => "deactivate",
            ]
        );
        $response->assertStatus(422);
    }
    public function testUpdateProductWithRedundantSkuPayload()
    {
        $product1 = Product::factory()->create([
            "sku" => "PRD-001"
        ]);
        $product2 = Product::factory()->create();
        $response = $this->putJson(
            '/api/v1/products/' .  $product2->id,
            [
                "sku" => "PRD-001",
            ]
        );
        $response->assertStatus(422)->assertJsonStructure([
            "title",
            "detail" => [
                "sku",
            ],
            "instance",
            "code",
            "link",
            "status"
        ]);
    }
    public function testUpdateProductWithValidPayload()
    {
        $product2 = Product::factory()->create();
        $response = $this->putJson(
            '/api/v1/products/' . $product2->id,
            [
                "sku" => "PRD-001",
                "name" => "Sample Product",
                "description" => "This is a sample product description",
                "price" => "99.99",
                "stock_quantity" => 100,
                "low_stock_threshold" => 10,
                "status" => "active",
            ]
        );
        $response->assertJsonFragment([
            "message" => 'Product Updated successfully',
        ])->assertStatus(200);
    }
}
