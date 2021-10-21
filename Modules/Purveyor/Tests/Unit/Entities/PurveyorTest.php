<?php

namespace Modules\purveyor\Tests\Unit\Entities;

use Modules\Purveyor\Entities\Purveyor;
use Tests\TestCase;

class PurveyorTest extends TestCase
{
    protected $purveyor;

    protected function setup(): void
    {
        parent::setUp();

        $this->purveyor = new Purveyor();
    }

    /**
     * @dataProvider activeAttributeDataProvider
     */
    public function test_it_formats_active_attribute($value, $expected_result)
    {
        $this->purveyor->active = $value;

        $this->assertEquals($this->purveyor->formatted_active, $expected_result);
    }

    public function test_it_formats_category_name_attribute()
    {
        $this->purveyor->categories = ['cat1', 'cat2'];

        $this->assertEquals($this->purveyor->formatted_category_name, "", "");
    }


    public function activeAttributeDataProvider()
    {
        yield 'formatted_active deve retornar Sim' => [
            'value' => true,
            'expected_result' => 'Sim'
        ];

        yield 'formatted_active deve retornar Não' => [
            'value' => false,
            'expected_result' => 'Não'
        ];
    }
}
