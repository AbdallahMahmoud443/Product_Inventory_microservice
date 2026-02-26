<?php

namespace Tests\Feature\product;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    public function testDeleteProductWithValidPayload()
    {
        $product = Product::factory()->create();
        $this->assertDatabaseHas('products', ['id' => $product->id]);
        $response = $this->deleteJson(
            '/api/v1/products/' . $product->id,

        );
        $response->assertJsonFragment([
            "message" => 'Product Delete successfully',
        ])->assertStatus(200);
    }
}
