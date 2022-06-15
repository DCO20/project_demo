<?php

namespace Modules\Product\Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use Modules\Product\Entities\Product;
use Modules\Category\Entities\Category;

class ProductControllerTest extends TestCase
{
    protected $user;

    protected function setup(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_route_index()
    {
        $response = $this->actingAs($this->user)->get(route('product.index'));

        $response->assertSuccessful();

        $response->assertSee('Produtos');
    }

    public function test_route_create()
    {
        $response = $this->actingAs($this->user)->get(route('product.create'));

        $response->assertSuccessful();

        $response->assertSee('Produtos');
    }

    public function test_route_store()
    {
        $category = Category::factory()->create();

        $data = [
            'name' => 'Smartphone',
            'active' => true,
            'price' => '2255.00',
            'categories' => $category->pluck('id')
        ];

        $response = $this->actingAs($this->user)->post(route('product.store'), $data);

        $response->assertRedirect(route('product.index'));

        $response->assertSessionHas('message', 'Cadastro realizado com sucesso.');

        $this->assertDatabaseCount('products', 1);

        $this->assertDatabaseHas('products', [
            'name' => 'Smartphone'
        ]);
    }

    public function test_route_show()
    {
        $product = Product::factory()->hasCategories()->create();

        $response = $this->actingAs($this->user)->get(route('product.show', [
            'id' => $product->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($product->name);
    }

    public function test_route_edit()
    {
        $product = Product::factory()->hasCategories()->create();

        $response = $this->actingAs($this->user)->get(route('product.edit', [
            'id' => $product->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($product->name);
    }

    public function test_route_update()
    {
        $category = Category::factory()->create();

        $product = product::factory()->create();

        $data = [
            'name' => 'Smartphone',
            'active' => true,
            'price' => '2255.00',
            'categories' => $category->pluck('id')
        ];

        $response = $this->actingAs($this->user)->put(route('product.update', $product->id), $data);

        $response->assertRedirect(route('product.edit', $product->id));

        $response->assertSessionHas('message', 'Atualização realizada com sucesso.');

        $this->assertDatabaseHas('products', [
            'name' => 'Smartphone'
        ]);
    }

    public function test_route_confirm_delete()
    {
        $product = Product::factory()->create();

        $response = $this->actingAs($this->user)->get(route('product.confirm_delete', [
            'id' => $product->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($product->name);
    }

    public function test_route_delete()
    {
        $product = Product::factory()->create();

        $response = $this->actingAs($this->user)->delete(route('product.delete', [
            'id' =>  $product->id
        ]));

        $response->assertRedirect(route('product.index'));

        $response->assertSessionHas('message', 'Exclusão realizada com sucesso.');

        $this->assertDeleted('products', $product->toArray());

        $this->assertSoftDeleted($product);

        $this->assertDatabaseCount('products', 1);
    }
}
