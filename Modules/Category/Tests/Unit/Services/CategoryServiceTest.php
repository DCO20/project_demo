<?php

namespace Modules\Category\Tests\Unit\Services;

use Modules\Category\Entities\Category;
use Modules\Category\Services\CategoryService;
use Tests\TestCase;

class CategoryServiceTest extends TestCase
{
    protected $category_service;

    protected function setup(): void
    {
        parent::setUp();

        $this->category_service = new CategoryService();
    }

    public function test_route_update_or_create_exception()
    {
        $this->expectException(\Exception::class);

        $this->category_service->updateOrCreate([]);
    }

    public function test_route_remove_data_exception()
    {
        $this->expectException(\Exception::class);

        $category = $this->mock(Category::class);

        $this->category_service->removeData($category);
    }
}
