<?php

namespace Modules\Suit\Tests\Unit\Presenter;

use Tests\TestCase;
use Modules\Suit\Entities\Suit;
use Modules\Suit\Entities\SuitProduct;

class SuitPresenterTest extends TestCase
{
    public function test_it_gets_action_view()
    {
        $Suit = new Suit();

        $Suit->id = 123;

        $this->assertStringContainsString($Suit->id, $Suit->actionView());
    }

     public function test_it_total()
    {
        $suit = Suit::factory()->hasSuitProducts(
            SuitProduct::factory([
                'price' => '100,00',
                'amount' => 1
            ])
        )
            ->create();

       $this->assertEquals("R$ 100,00", $suit->total());
    }
}
