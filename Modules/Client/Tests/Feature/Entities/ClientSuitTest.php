<?php

namespace Modules\Client\Tests\Feature\Entities;

use Tests\TestCase;
use Modules\Suit\Entities\Suit;
use Modules\Client\Entities\Client;
use Modules\Client\Entities\ClientSuit;

class ClientSuitTest extends TestCase
{
    public function test_a_client_belongs_to_suit()
    {
        $client_suit = ClientSuit::factory()->create();

        $this->assertInstanceOf(Client::class, $client_suit->client);
    }

    public function test_a_suit_belongs_to_client()
    {
        $client_suit = ClientSuit::factory()->create();

        $this->assertInstanceOf(Suit::class, $client_suit->suit);
    }
}
