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
        $suit = Suit::factory()->hasSuitProducts()->create();

        $suit->load('suitProducts.category');

        $this->assertInstanceOf(Category::class, $suit->suitProducts->first()->category);
    }

    public function test_a_suit_product_belongs_to_product()
    {
        $suit = Suit::factory()->hasSuitProducts()->create();

        $suit->load('suitProducts.product');

        $this->assertInstanceOf(Product::class, $suit->suitProducts->first()->product);
    }

    public function test_a_suit_product_belongs_to_purveyor()
    {
        $suit = Suit::factory()->hasSuitProducts()->create();

        $suit->load('suitProducts.purveyor');

        $this->assertInstanceOf(Purveyor::class, $suit->suitProducts->first()->purveyor);
    }

    public function test_a_suit_product_belongs_to_suit()
    {
        $suit = Suit::factory()->hasSuitProducts()->create();

        $suit_product = SuitProduct::with('suit')->first();

        $this->assertInstanceOf(Suit::class, $suit_product->suit);
    }
}
