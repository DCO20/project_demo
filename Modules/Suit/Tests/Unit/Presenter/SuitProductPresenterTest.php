<?php

namespace Modules\Suit\Tests\Unit\Presenter;

use Tests\TestCase;
use Modules\Suit\Entities\SuitProduct;

class SuitProductPresenterTest extends TestCase
{
    public function test_it_total()
    {
        $suit_product = new SuitProduct();

        $suit_product->price = 400 ;

        $suit_product->amount = 2;


        $this->assertStringContainsString( 'R$ 800,00', $suit_product->total());
    }
}
