<?php

namespace Modules\Suit\Tests\Unit\Entities;

use Tests\TestCase;
use Modules\Suit\Entities\SuitProduct;

class SuitProductTest extends TestCase
{
    public function test_it_formats_price_attribute()
    {
        $suit_product = new SuitProduct();

        $suit_product->price = '1.000,00';

        $this->assertEquals( $suit_product->formatted_price, 'R$ 1.000,00');
    }

}
