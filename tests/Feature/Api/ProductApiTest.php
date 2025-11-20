<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Ejecutar seeders necesarios
        $this->artisan('db:seed', ['--class' => 'CategorySeeder']);
    }

    /**
     * Test de listado de productos
     */
    public function test_can_get_products_list(): void
    {
        $user = User::factory()->create();
        $token = auth()->guard('api')->login($user);

        Product::factory()->count(5)->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->getJson('/api/products');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'products',
                    'pagination',
                ],
            ]);
    }

    /**
     * Test de obtener un producto específico
     */
    public function test_can_get_single_product(): void
    {
        $user = User::factory()->create();
        $token = auth()->guard('api')->login($user);

        $product = Product::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->getJson("/api/products/{$product->id}");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'id' => $product->id,
                    'name' => $product->name,
                ],
            ]);
    }

    /**
     * Test de filtrado de productos por categoría
     */
    public function test_can_filter_products_by_category(): void
    {
        $user = User::factory()->create();
        $token = auth()->guard('api')->login($user);

        $category = Category::first();
        Product::factory()->count(3)->create(['category_id' => $category->id]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->getJson("/api/products?category_id={$category->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => ['products', 'pagination'],
            ]);
    }

    /**
     * Test de creación de producto (solo admin/seller)
     */
    public function test_admin_can_create_product(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $token = auth()->guard('api')->login($admin);

        $category = Category::first();

        $productData = [
            'name' => 'Nuevo Producto Test',
            'description' => 'Descripción del producto',
            'sku' => 'TEST-SKU-001',
            'price' => 99.99,
            'sale_price' => 79.99,
            'stock_quantity' => 100,
            'category_id' => $category->id,
            'is_active' => true,
            'is_featured' => false,
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->postJson('/api/products', $productData);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Producto creado exitosamente',
            ]);

        $this->assertDatabaseHas('products', [
            'sku' => 'TEST-SKU-001',
        ]);
    }

    /**
     * Test de que un customer no puede crear productos
     */
    public function test_customer_cannot_create_product(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $token = auth()->guard('api')->login($customer);

        $category = Category::first();

        $productData = [
            'name' => 'Nuevo Producto Test',
            'sku' => 'TEST-SKU-002',
            'price' => 99.99,
            'stock_quantity' => 100,
            'category_id' => $category->id,
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->postJson('/api/products', $productData);

        $response->assertStatus(403)
            ->assertJson([
                'success' => false,
                'message' => 'No tiene permisos para acceder a este recurso',
            ]);
    }

    /**
     * Test de actualización de producto
     */
    public function test_seller_can_update_product(): void
    {
        $seller = User::factory()->create(['role' => 'seller']);
        $token = auth()->guard('api')->login($seller);

        $product = Product::factory()->create();

        $updateData = [
            'name' => 'Producto Actualizado',
            'price' => 149.99,
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->putJson("/api/products/{$product->id}", $updateData);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Producto actualizado exitosamente',
            ]);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Producto Actualizado',
            'price' => 149.99,
        ]);
    }

    /**
     * Test de eliminación de producto
     */
    public function test_admin_can_delete_product(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $token = auth()->guard('api')->login($admin);

        $product = Product::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->deleteJson("/api/products/{$product->id}");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Producto eliminado exitosamente',
            ]);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

    /**
     * Test de búsqueda de productos
     */
    public function test_can_search_products(): void
    {
        $user = User::factory()->create();
        $token = auth()->guard('api')->login($user);

        Product::factory()->create(['name' => 'Laptop Gaming']);
        Product::factory()->create(['name' => 'Mouse Inalámbrico']);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->getJson('/api/products?search=Laptop');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => ['products', 'pagination'],
            ]);
    }
}
