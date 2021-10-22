<?php

namespace Modules\Client\Tests\Feature\Entities;

use Tests\TestCase;
use Modules\Suit\Entities\Suit;
use Modules\Client\Entities\Client;

class ClientTest extends TestCase
{
    public function test_client_has_suits()
    {
        $client = Client::factory()->hasAttached(
            Suit::factory()->count(2)
        )
            ->create();

        $this->assertInstanceOf(Suit::class, $client->suits->first());

        $this->assertInstanceOf(Suit::class, $client->suits->last());
    }
}
