<?php

namespace Modules\Category\Tests\Feature\Entities;

use Tests\TestCase;
use Modules\Category\Entities\Category;
use Modules\Purveyor\Entities\Purveyor;
use Modules\Category\Entities\CategoryPurveyor;

class CategoryPurveyorTest extends TestCase
{
    public function test_a_category_belongs_to_purveyor()
    {
         $category_purveyor = CategoryPurveyor::factory()->create();

        $this->assertInstanceOf(Purveyor::class, $category_purveyor->purveyor);
    }

    public function test_a_purveyor_belongs_to_category()
    {
         $category_purveyor = CategoryPurveyor::factory()->create();

        $this->assertInstanceOf(Category::class, $category_purveyor->category);
    }
}
