<?php

namespace Modules\Product\Tests\Unit\Presenter;

use Tests\TestCase;
use Modules\Product\Entities\Product;

class ProductPresenterTest extends TestCase
{
    public function test_it_gets_action_view()
    {
        $product = new Product();

        $product->id = 123;

        $this->assertStringContainsString($product->id, $product->actionView());
    }
}
