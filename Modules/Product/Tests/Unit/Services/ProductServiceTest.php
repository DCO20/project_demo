<?php

namespace Modules\Product\Tests\Unit\Services;

use Modules\Product\Entities\Product;
use Modules\Product\Services\ProductService;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    protected $product_service;

    protected function setup(): void
    {
        parent::setUp();

        $this->product_service = new ProductService();
    }

    public function test_route_update_or_create_exception()
    {
        $this->expectException(\Exception::class);

        $this->product_service->updateOrCreate([]);
    }

    public function test_route_remove_data_exception()
    {
        $this->expectException(\Exception::class);

        $product = $this->mock(Product::class);

        $this->product_service->removeData($product);
    }
}
