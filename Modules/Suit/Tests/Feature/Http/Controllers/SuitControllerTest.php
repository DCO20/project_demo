<?php

namespace Modules\Suit\Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use Modules\Suit\Entities\Suit;
use Modules\Client\Entities\Client;
use Modules\Product\Entities\Product;
use Modules\Category\Entities\Category;
use Modules\Purveyor\Entities\Purveyor;

class SuitControllerTest extends TestCase
{
    protected $user;

    protected function setup(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_route_index()
    {
        $response = $this->actingAs($this->user)->get(route('suit.index'));

        $response->assertSuccessful();

        $response->assertSee('Pedidos');
    }

    public function test_route_create()
    {
        $response = $this->actingAs($this->user)->get(route('suit.create'));

        $response->assertSuccessful();

        $response->assertSee('Pedidos');
    }

    public function test_route_store()
    {
        $client = Client::factory()->create();

        $purveyor = Purveyor::factory()->hasAttached(
            Category::factory()->hasAttached(
                Product::factory()->count(2)
            )
        )
            ->create();

        $purveyor->load('categories.products');

        $data = [
            'date' => now()->format('Y-m-d'),
            'status' => Suit::FINISHED,
            'description' => 'Teste',
            'client_id' => $client->id,
            'products' => [
                0 => [
                    'amount' => 10,
                    'price' => '200.00',
                    'purveyor_id' => $purveyor->id,
                    'category_id' => $purveyor->categories->first()->id,
                    'product_id' =>  $purveyor->categories->first()->products->first()->id
                ],
                1 => [
                    'amount' => 10,
                    'price' => '200.00',
                    'purveyor_id' => $purveyor->id,
                    'category_id' =>  $purveyor->categories->first()->id,
                    'product_id' =>  $purveyor->categories->first()->products->last()->id
                ],
            ]

        ];

        $response = $this->actingAs($this->user)->post(route('suit.store'), $data);

        $response->assertRedirect(route('suit.index'));

        $response->assertSessionHas('message', 'Cadastro realizado com sucesso.');

        $this->assertDatabaseCount('suits', 1);

        $this->assertDatabaseHas('suits', [
            'description' => 'Teste'
        ]);
    }

    public function test_route_show()
    {
        $suit = Suit::factory()->hasClient()->hasSuitProducts()->create();

        $response = $this->actingAs($this->user)->get(route('suit.show', [
            'id' => $suit->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($suit->formatted_suit_date);
    }

    public function test_route_edit()
    {
        $suit = Suit::factory()->hasClient()->hasSuitProducts()->create();

        $response = $this->actingAs($this->user)->get(route('suit.edit', [
            'id' => $suit->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($suit->formatted_suit_date);
    }

    public function test_route_update()
    {
        $suit =  Suit::factory()->create();

        $client = Client::factory()->create();

        $purveyor = Purveyor::factory()->hasAttached(
            Category::factory()->hasAttached(
                Product::factory()->count(2)
            )
        )
            ->create();

        $purveyor->load('categories.products');

        $data = [
            'date' => now()->format('Y-m-d'),
            'status' => Suit::FINISHED,
            'description' => 'Teste',
            'client_id' => $client->id,
            'products' => [
                0 => [
                    'amount' => 10,
                    'price' => '200.00',
                    'purveyor_id' => $purveyor->id,
                    'category_id' => $purveyor->categories->first()->id,
                    'product_id' =>  $purveyor->categories->first()->products->first()->id
                ],
                1 => [
                    'amount' => 10,
                    'price' => '200.00',
                    'purveyor_id' => $purveyor->id,
                    'category_id' =>  $purveyor->categories->first()->id,
                    'product_id' =>  $purveyor->categories->first()->products->last()->id
                ],
            ]

        ];

        $response = $this->actingAs($this->user)->put(route('suit.update', $suit->id), $data);

        $response->assertRedirect(route('suit.edit', $suit->id));

        $response->assertSessionHas('message', 'Atualização realizada com sucesso.');

        $this->assertDatabaseHas('suits', [
            'description' => 'Teste'
        ]);
    }

    public function test_route_confirm_delete()
    {
        $suit = Suit::factory()->hasClient()->create();

        $response = $this->actingAs($this->user)->get(route('suit.confirm_delete', [
            'id' => $suit->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($suit->formatted_date);
    }

    public function test_route_delete()
    {
        $suit = Suit::factory()->create();

        $response = $this->actingAs($this->user)->delete(route('suit.delete', [
            'id' =>  $suit->id
        ]));

        $response->assertRedirect(route('suit.index'));

        $response->assertSessionHas('message', 'Exclusão realizada com sucesso.');

        $this->assertDeleted('suits', $suit->toArray());

        $this->assertSoftDeleted($suit);

        $this->assertDatabaseCount('suits', 1);
    }

    public function test_route_add_purveyor()
    {
        $suit = Purveyor::factory()->create();

        $response = $this->actingAs($this->user)->post(route('suit.add_purveyor', [
            'id' =>  $suit->id
        ]));

        $response->assertSuccessFul()->assertJson([
            'success' => true
        ]);
    }

    public function test_load_category()
    {
        $purveyor = Purveyor::factory()->hasAttached(
            Category::factory()->count(2)
        )
            ->create();

        $response = $this->actingAs($this->user)->post(route('suit.load_category', [
            'purveyor_id' =>  $purveyor->id
        ]));

        $response->assertSuccessful();
    }

    public function test_load_product()
    {
        $category = Category::factory()->hasAttached(
            Product::factory()->count(2)
        )
            ->create();

        $response = $this->actingAs($this->user)->post(route('suit.load_product', [
            'category_id' =>  $category->id
        ]));

        $response->assertSuccessful();
    }
}
