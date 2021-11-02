<?php

namespace Modules\Suit\Tests\Feature\Entities;

use Tests\TestCase;
use Modules\Suit\Entities\Suit;
use Modules\Client\Entities\Client;
use Modules\Product\Entities\Product;
use Modules\Suit\Entities\SuitProduct;
use Modules\Category\Entities\Category;
use Modules\Purveyor\Entities\Purveyor;

class SuitTest extends TestCase
{
    public function test_a_suit_belongs_to_client()
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

    public function test_it_filter_purveyor()
    {
        Purveyor::factory()->create();

        $suit = Suit::factory()->hasSuitProducts()->create();

        $item = $suit->suitProducts->first();

        $purveyors = $suit->filterPurveyor($item);

        $this->assertEquals(1, $purveyors->count());
    }

    public function test_it_filter_category()
    {
        $purveyor = Purveyor::factory()->hasAttached(
            Category::factory()->count(2)
        )
            ->create();

        $purveyor->load('categories');

        $item = [
            'purveyor_id' => $purveyor->id,
            'category_id' => $purveyor->categories->first()->id
        ];

        $categories = (new Suit)->filterCategory($item);

        $this->assertEquals(1, $categories->count());
    }

    public function test_it_filter_product()
    {
        $category = Category::factory()->hasAttached(
            Product::factory()->count(2)
        )
            ->create();

        $category->load('products');

        $item = [
            'category_id' => $category->id,
            'product_id' => $category->products->first()->id
        ];

        $products = (new Suit)->filterProduct($item);

        $this->assertEquals(1, $products->count());
    }
}
