<?php

namespace Modules\Product\Tests\Unit\Entities;

use Tests\TestCase;
use Modules\Product\Entities\Product;

class ProductTest extends TestCase
{
    protected $product;

    protected function setup(): void
    {
        parent::setUp();

        $this->product = new Product();
    }

    /**
     * @dataProvider activeAttributeDataProvider
     */
    public function test_it_formats_active_attribute($value, $expected_result)
    {
        $this->product->active = $value;

        $this->assertEquals($this->product->formatted_active, $expected_result);
    }

    public function test_it_formats_price_attribute()
    {
        $this->product->price = '1.000,00';

        $this->assertEquals('1.000,00', $this->product->formatted_price);
    }

    public function activeAttributeDataProvider()
    {
        yield 'formatted_active deve retornar Sim' => [
            'value' => true,
            'expected_result' => 'Sim'
        ];

        yield 'formatted_active deve retornar Não' => [
            'value' => false,
            'expected_result' => 'Não'
        ];
    }
}
