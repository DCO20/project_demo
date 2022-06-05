<?php

namespace Modules\Purveyor\Tests\Unit\Entities;

use Modules\Purveyor\Entities\Purveyor;
use Tests\TestCase;

class PurveyorTest extends TestCase
{
    /**
     * @dataProvider activeAttributeDataProvider
     */
   public function test_it_formats_active_attribute($value, $expected_result)
    {
        $purveyor = new Purveyor();

        $purveyor->active = $value;

        $this->assertEquals($purveyor->formatted_active, $expected_result);
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
