<?php
namespace Modules\Client\Database\factories;

use Modules\Suit\Entities\Suit;
use Modules\Client\Entities\Client;
use Modules\Client\Entities\ClientSuit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientSuitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClientSuit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => Client::factory()->create()->id,
            'suit_id' => Suit::factory()->create()->id
        ];
    }
}
