<?php

namespace Modules\Suit\Tests\Unit\Entities;

use Tests\TestCase;
use Modules\Suit\Entities\Suit;

class SuitTest extends TestCase
{
    protected $Suit;

    protected function setup(): void
    {
        parent::setUp();

        $this->Suit = new Suit();
    }

    /**
     * @dataProvider genreAttributeDataProvider
     */
    public function test_it_formats_status_attribute($value, $expected_result)
    {
        $this->Suit->status = $value;

        $this->assertEquals($this->Suit->formatted_status, $expected_result);
    }

    public function test_it_formats_date_birthday_attribute()
    {
        $this->Suit->date = '2021-10-21';

        $this->assertEquals($this->Suit->formatted_date, '21/10/2021');
    }

    public function genreAttributeDataProvider()
    {
        yield 'formatted_status deve retornar Finalizado' => [
            'value' => Suit::FINISHED,
            'expected_result' => 'Finalizado'
        ];

        yield 'formatted_genre deve retornar Pendente' => [
            'value' => Suit::PENDING,
            'expected_result' => 'Pendente'
        ];
    }
}
