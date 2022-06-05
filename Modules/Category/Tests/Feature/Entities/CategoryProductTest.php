<?php

namespace Modules\Category\Tests\Feature\Entities;

use Tests\TestCase;
use Modules\Product\Entities\Product;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\CategoryProduct;

class CategoryProductTest extends TestCase
{
    public function test_a_category_belongs_to_product()
    {
        $category_product = CategoryProduct::factory()->create();

        $this->assertInstanceOf(Product::class, $category_product->product);
    }

    public function test_a_product_belongs_to_category()
    {
        $category_product = CategoryProduct::factory()->create();

        $this->assertInstanceOf(Category::class, $category_product->category);
    }
}
