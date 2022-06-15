<?php

namespace Modules\Purveyor\Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use Modules\Category\Entities\Category;
use Modules\purveyor\Entities\Purveyor;

class PurveyorControllerTest extends TestCase
{
    protected $user;

    protected function setup(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_route_index()
    {
        $response = $this->actingAs($this->user)->get(route('purveyor.index'));

        $response->assertSuccessful();

        $response->assertSee('Fornecedores');
    }

    public function test_route_create()
    {
        $response = $this->actingAs($this->user)->get(route('purveyor.create'));

        $response->assertSuccessful();

        $response->assertSee('Fornecedores');
    }

    public function test_route_store()
    {
        $category = Category::factory()->create();

        $data = [
            'name' => 'Danilo Oliveira',
            'cnpj' => '2222222222222',
            'active' => true,
            'categories' => $category->pluck('id')
        ];

        $response = $this->actingAs($this->user)->post(route('purveyor.store'), $data);

        $response->assertRedirect(route('purveyor.index'));

        $response->assertSessionHas('message', 'Cadastro realizado com sucesso.');

        $this->assertDatabaseCount('purveyors', 1);

        $this->assertDatabaseHas('purveyors', [
            'name' => 'Danilo Oliveira'
        ]);
    }

    public function test_route_show()
    {
        $purveyor = purveyor::factory()->hasCategories()->create();

        $response = $this->actingAs($this->user)->get(route('purveyor.show', [
            'id' => $purveyor->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($purveyor->name);
    }

    public function test_route_edit()
    {
        $purveyor = purveyor::factory()->hasCategories()->create();

        $response = $this->actingAs($this->user)->get(route('purveyor.edit', [
            'id' => $purveyor->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($purveyor->name);
    }

    public function test_route_update()
    {
        $category = Category::factory()->create();

        $purveyor = Purveyor::factory()->create();

        $data = [
            'name' => 'Danilo Oliveira',
            'cnpj' => '2222222222222',
            'active' => true,
            'categories' => $category->pluck('id')
        ];

        $response = $this->actingAs($this->user)->put(route('purveyor.update', $purveyor->id), $data);

        $response->assertRedirect(route('purveyor.edit', $purveyor->id));

        $response->assertSessionHas('message', 'Atualização realizada com sucesso.');

        $this->assertDatabaseHas('purveyors', [
            'name' => 'Danilo Oliveira'
        ]);
    }

    public function test_route_confirm_delete()
    {
        $purveyor = purveyor::factory()->create();

        $response = $this->actingAs($this->user)->get(route('purveyor.confirm_delete', [
            'id' => $purveyor->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($purveyor->name);
    }

    public function test_route_delete()
    {
        $purveyor = purveyor::factory()->create();

        $response = $this->actingAs($this->user)->delete(route('purveyor.delete', [
            'id' =>  $purveyor->id
        ]));

        $response->assertRedirect(route('purveyor.index'));

        $response->assertSessionHas('message', 'Exclusão realizada com sucesso.');

        $this->assertDeleted('purveyors', $purveyor->toArray());

        $this->assertSoftDeleted($purveyor);

        $this->assertDatabaseCount('purveyors', 1);
    }
}
