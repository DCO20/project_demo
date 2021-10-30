<?php

namespace Modules\Suit\Tests\Feature\Entities;

use Tests\TestCase;
use Modules\Suit\Entities\Suit;
use Modules\Client\Entities\Client;
use Modules\Suit\Entities\SuitProduct;

class SuitTest extends TestCase
{
    public function test_suit_has_client()
    {
        $suit = Suit::factory()->create();

        $this->assertInstanceOf(Client::class, $suit->client);
    }

    public function test_suit_has_suit_products()
    {
        $suit = Suit::factory()->hasSuitProducts(
            SuitProduct::factory()->count(2)
        )
            ->create();

        $this->assertInstanceOf(SuitProduct::class, $suit->suitProducts->first());

        $this->assertInstanceOf(SuitProduct::class, $suit->suitProducts->last());
    }
}
