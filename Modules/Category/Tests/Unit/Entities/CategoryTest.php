<?php

namespace Modules\Category\Tests\Unit\Enties;

use Tests\TestCase;
use Modules\Category\Entities\Category;

class CategoryTest extends TestCase
{
    /**
     * @dataProvider activeAttributeDataProvider
     */
    public function test_it_formats_active_attribute($value, $expected_result)
    {
        $category = new Category();

        $category->active = $value;

        $this->assertEquals($category->formatted_active, $expected_result);
    }

    public function activeAttributeDataProvider()
    {
        return [
            [false, 'Não'],
            [true, 'Sim']
        ];
    }
}
