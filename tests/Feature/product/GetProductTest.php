<?php

namespace Tests\Feature\product;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetProductTest extends TestCase
{
    public function testGetProducts()
    {
        Product::factory(10)->create();
        $response = $this->getJson('/api/v1/products/');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'sku',
                        'name',
                        'description',
                        'price',
                        'stock_quantity',
                        'low_stock_threshold',
                        'status',
                        'created_at',
                        'updated_at'
                    ]
                ],
                'links',
                'meta'
            ])
            ->assertJsonCount(10, 'data');
    }
    public function testGetProductWithValidId()
    {
        $product = Product::factory()->create();
        $response = $this->getJson('/api/v1/products/' . $product->id);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [

                    'id',
                    'sku',
                    'name',
                    'description',
                    'price',
                    'stock_quantity',
                    'low_stock_threshold',
                    'status',
                    'created_at',
                    'updated_at'

                ],
            ]);
    }
    public function testGetProductWithInValidId()
    {

        $response = $this->getJson('/api/v1/products/' . 123);
        $response->assertStatus(404)->assertJsonFragment([
            "title" => "Resource not found"
        ]);
    }
}
