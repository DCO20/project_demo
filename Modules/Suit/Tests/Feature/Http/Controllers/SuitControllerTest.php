<?php

namespace Modules\Suit\Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Modules\Suit\Entities\Suit;
use Modules\Client\Entities\Client;

class SuitControllerTest extends TestCase
{
    public function test_route_index()
    {
        $response = $this->get(route('suit.index'));

        $response->assertSuccessful();

        $response->assertSee('Pedidos');
    }

    public function test_route_create()
    {
        $response = $this->get(route('suit.create'));

        $response->assertSuccessful();

        $response->assertSee('Pedidos');
    }

    public function test_route_store()
    {
        $Client = Client::factory()->create();

        $data = [
            'suit_date' => '2021-10-21',
            'status' => Suit::FINISHED,
            'note' => 'Teste',
            'clients' => $Client->pluck('id')
        ];

        $response = $this->post(route('suit.store'), $data);

        $response->assertRedirect(route('suit.index'));

        $response->assertSessionHas('message', 'Cadastro realizado com sucesso.');

        $this->assertDatabaseCount('suits', 1);

        $this->assertDatabaseHas('suits', [
            'note' => 'Teste'
        ]);
    }

    public function test_route_show()
    {
        $Suit = Suit::factory()->create();

        $response = $this->get(route('suit.show', [
            'id' => $Suit->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($Suit->formatted_suit_date);
    }

    public function test_route_edit()
    {
        $Suit = Suit::factory()->create();

        $response = $this->get(route('suit.edit', [
            'id' => $Suit->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($Suit->formatted_suit_date);
    }

    public function test_route_update()
    {
        $Client = Client::factory()->create();

        $suit = Suit::factory()->create();

        $data = [
            'suit_date' => '2021-10-21',
            'status' => Suit::FINISHED,
            'note' => 'Teste',
            'clients' => $Client->pluck('id')
        ];

        $response = $this->put(route('suit.update', $suit->id), $data);

        $response->assertRedirect(route('suit.edit', $suit->id));

        $response->assertSessionHas('message', 'Atualização realizada com sucesso.');

        $this->assertDatabaseHas('suits', [
            'note' => 'Teste'
        ]);
    }

    public function test_route_confirm_delete()
    {
        $suit = Suit::factory()->create();

        $response = $this->get(route('suit.confirm_delete', [
            'id' => $suit->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($suit->formatted_suit_date);
    }

    public function test_route_delete()
    {
        $suit = Suit::factory()->create();

        $response = $this->delete(route('suit.delete', [
            'id' =>  $suit->id
        ]));

        $response->assertRedirect(route('suit.index'));

        $response->assertSessionHas('message', 'Exclusão realizada com sucesso.');

        $this->assertDeleted('suits', $suit->toArray());

        $this->assertSoftDeleted($suit);

        $this->assertDatabaseCount('suits', 1);
    }
}
