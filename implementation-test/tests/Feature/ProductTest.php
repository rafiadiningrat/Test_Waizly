<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_product()
    {
        
        $user = User::factory()->create();

      
        Sanctum::actingAs($user, ['*']);

        
        $data = [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 99.99
        ];

        $response = $this->postJson('/api/products', $data);

        
        $response->assertStatus(200)
                 ->assertJson(['name' => 'Test Product']);
    }

    public function test_can_view_product()
    {
        
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);
        $product = Product::factory()->create();
        $response = $this->getJson("/api/products/{$product->id}");
        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $product->id,
                     'name' => $product->name,
                     'description' => $product->description,
                     'price' => $product->price,
                 ]);
    }

    public function test_can_update_product()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);
        $product = Product::factory()->create();

        $data = [
            'name' => 'Updated Product',
            'description' => 'Updated Description',
            'price' => 199.99
        ];
        $response = $this->putJson("/api/products/{$product->id}", $data);
        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $product->id,
                     'name' => 'Updated Product',
                     'description' => 'Updated Description',
                     'price' => 199.99,
                 ]);
    }

    public function test_can_delete_product()
    {

        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);
        $product = Product::factory()->create();
        $response = $this->deleteJson("/api/products/{$product->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
