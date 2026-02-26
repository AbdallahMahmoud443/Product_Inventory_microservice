<?php

namespace Tests\Feature\product;

use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    public function testCreateProductWithEmptyPayload()
    {
        $response = $this->postJson('http://127.0.0.1:8000/api/v1/products/', []);
        $response->assertStatus(422)
            ->assertJsonFragment([
                "title" => "Validation failed",
                "code" => "VALIDATION_FAILED",
                "instance" => "api/v1/products"
            ])
            ->assertJsonStructure([
                "title",
                "detail" => [
                    "sku",
                    "name",
                    "price",
                    "stock_quantity",
                    "status"

                ],
                "instance",
                "code",
                "link",
                "status"
            ]);
    }
    public function testCreateProductWithInvalidPayload()
    {
        $response = $this->postJson(
            'http://127.0.0.1:8000/api/v1/products/',
            [
                "sku" => "PRD-001",
                "name" => "Sample Product",
                "description" => "This is a sample product description",
                "price" => "99.99",
                "stock_quantity" => "test",
                "low_stock_threshold" => 10,
                "status" => "deactivate",
            ]
        );
        $response->assertStatus(422)
            ->assertJsonFragment([
                "title" => "Validation failed",
                "code" => "VALIDATION_FAILED",
                "instance" => "api/v1/products"
            ])
            ->assertJsonStructure([
                "title",

                "instance",
                "code",
                "link",
                "status"
            ]);
    }
    public function testCreateProductWithRedundantSkuPayload()
    {
        Product::factory()->create([
            "sku" => "PRD-001"
        ]);
        $response = $this->postJson(
            'http://127.0.0.1:8000/api/v1/products/',
            [
                "sku" => "PRD-001",
                "name" => "Sample Product",
                "description" => "This is a sample product description",
                "price" => "99.99",
                "stock_quantity" => "test",
                "low_stock_threshold" => 10,
                "status" => "deactivate",
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
    public function testCreateProductWithValidPayload()
    {
        $response = $this->postJson(
            'http://127.0.0.1:8000/api/v1/products/',
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
        $this->assertDatabaseCount('products', 1);
        $response->assertJsonFragment([
            "message" => 'Product created successfully',
        ])->assertStatus(201);
    }
}
