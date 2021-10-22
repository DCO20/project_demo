<?php

namespace Modules\Suit\Tests\Feature\Entities;

use Tests\TestCase;
use Modules\Client\Entities\Client;
use Modules\Suit\Entities\Suit;

class SuitTest extends TestCase
{
    public function test_it_formats_client_name_attribute()
    {
        $Suit = Suit::factory()->hasAttached(
            Client::factory()->create([
                'name' => 'Danilo'
            ])
        )
            ->create();

        $this->assertEquals('Danilo', $Suit->formatClientName());
    }

    public function test_suit_has_clients()
    {
        $suit = Suit::factory()->hasAttached(
            Client::factory()->count(2)
        )
            ->create();

        $this->assertInstanceOf(Client::class, $suit->clients->first());

        $this->assertInstanceOf(Client::class, $suit->clients->last());
    }
}
