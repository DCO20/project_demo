<?php

namespace Modules\Category\Tests\Feature\Entities;

use Tests\TestCase;
use Modules\Product\Entities\Product;
use Modules\Category\Entities\Category;
use Modules\Purveyor\Entities\Purveyor;

class CategoryTest extends TestCase
{
    public function test_category_has_products()
    {
        $category = Category::factory()->hasAttached(
            Product::factory()->count(2)
        )
            ->create();

        $this->assertInstanceOf(Product::class, $category->products->first());

        $this->assertInstanceOf(Product::class, $category->products->last());
    }

    public function test_category_has_purveyors()
    {
        $category = Category::factory()->hasAttached(
            Purveyor::factory()->count(2)
        )
            ->create();

        $this->assertInstanceOf(Purveyor::class, $category->purveyors->first());

        $this->assertInstanceOf(Purveyor::class, $category->purveyors->last());
    }
}
