<?php

namespace Modules\Product\Tests\Feature\Entities;

use Tests\TestCase;
use Modules\Category\Entities\Category;
use Modules\Product\Entities\Product;

class ProductTest extends TestCase
{
    public function test_it_formats_category_name_attribute()
    {
        $Product = Product::factory()->hasAttached(
            Category::factory()->create([
                'name' => 'categoria'
            ])
        )
            ->create();

        $this->assertEquals('categoria', $Product->formatCategoryName());
    }

    public function test_product_has_categories()
    {
        $product = Product::factory()->hasAttached(
           Category::factory()->count(2)
        )
            ->create();

        $this->assertInstanceOf(Category::class, $product->categories->first());

        $this->assertInstanceOf(Category::class, $product->categories->last());
    }
}
