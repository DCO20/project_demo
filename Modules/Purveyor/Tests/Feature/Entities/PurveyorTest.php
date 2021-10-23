<?php

namespace Modules\Purveyor\Tests\Feature\Entities;

use Tests\TestCase;
use Modules\Category\Entities\Category;
use Modules\Purveyor\Entities\Purveyor;

class PurveyorTest extends TestCase
{
    public function test_it_formats_category_name_attribute()
    {
        $purveyor = Purveyor::factory()->hasAttached(
            Category::factory()->create([
                'name' => 'categoria'
            ])
        )
            ->create();

        $this->assertEquals('categoria', $purveyor->formatCategoryName());
    }
    public function test_purveyor_has_categories()
    {
        $purveyor = Purveyor::factory()->hasAttached(
            Category::factory()->count(2)
        )
            ->create();

        $this->assertInstanceOf(Category::class, $purveyor->categories->first());

        $this->assertInstanceOf(Category::class, $purveyor->categories->last());
    }
}
