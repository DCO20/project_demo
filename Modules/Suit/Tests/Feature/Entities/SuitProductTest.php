<?php

namespace Modules\Suit\Tests\Feature\Entities;

use Tests\TestCase;
use Modules\Suit\Entities\Suit;
use Modules\Product\Entities\Product;
use Modules\Suit\Entities\SuitProduct;
use Modules\Category\Entities\Category;
use Modules\Purveyor\Entities\Purveyor;

class SuitProductTest extends TestCase
{
    public function test_a_suit_product_belongs_to_category()
    {
        $suit_product = SuitProduct::factory()->create();

        $this->assertInstanceOf(Category::class, $suit_product->category);
    }

    public function test_a_suit_product_belongs_to_product()
    {
        $suit_product = SuitProduct::factory()->create();

        $this->assertInstanceOf(Product::class, $suit_product->product);
    }

    public function test_a_suit_product_belongs_to_purveyor()
    {
        $suit_product = SuitProduct::factory()->create();

        $this->assertInstanceOf(Purveyor::class, $suit_product->purveyor);
    }

    public function test_a_suit_product_belongs_to_suit()
    {
        $suit_product = SuitProduct::factory()->create();

        $this->assertInstanceOf(Suit::class, $suit_product->suit);
    }
}
