<?php

namespace Modules\Category\Tests\Unit\Presenter;

use Tests\TestCase;
use Modules\Category\Entities\Category;

class CategoryPresenterTest extends TestCase
{
    public function test_it_gets_action_view()
    {
        $category = new Category();

        $category->id = 123;

        $this->assertStringContainsString($category->id, $category->actionView());
    }
}
