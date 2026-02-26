<?php

namespace Tests\Feature\stock;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StockTest extends TestCase
{

    public function testDecreaseStockQuantityWhenStockIsEmpty()
    {
        $product = Product::factory()->create([
            'stock_quantity' => 0
        ]);
        $response = $this->putJson('api/v1/products/' . $product->id . '/stock', [
            'adjustment' => -1
        ]);
        $response->assertStatus(500)->assertJsonFragment([
            'code' => 'INTERNAL_SERVER_ERROR',
            'detail' => 'stock quantity is not available',
            'status' => 500,
            'title' => 'Internal Server Error'
        ]);
    }
    public function testIncreaseStockQuantity()
    {
        $product = Product::factory()->create([
            'stock_quantity' => 20
        ]);
        $response = $this->putJson('api/v1/products/' . $product->id . '/stock/', [
            'adjustment' => 100
        ]);
        $response->assertStatus(200);
    }
    public function testIncreaseStockQuantityWhenStockBeEmpty()
    {
        $product = Product::factory()->create([
            'stock_quantity' => 0
        ]);
        $response = $this->putJson('api/v1/products/' . $product->id . '/stock/', [
            'adjustment' => 100
        ]);
        $response->assertStatus(200);
    }
    public function testDecreaseStockWithQuantityMoreThanStockItems()
    {
        $product = Product::factory()->create([
            'stock_quantity' => 20
        ]);
        $response = $this->putJson('api/v1/products/' . $product->id . '/stock', [
            'adjustment' => -30
        ]);
        $response->assertStatus(500)->assertJsonStructure([
            'title',
            'detail',
            'instance',
            'code',
            "link",
            'status',

        ]);
    }
    public function testFetchProductsBelowThreshold()
    {
        Product::factory(10)->create([
            'stock_quantity' => 20,
            'low_stock_threshold' => 30
        ]);
        Product::factory(5)->create([
            'stock_quantity' => 50,
            'low_stock_threshold' => 30
        ]);
        $this->assertDatabaseCount('products', 15);
        $this->getJson('api/v1/products/low-stock')->assertJsonCount(10, 'data')->assertStatus(200);
    }
}
