<?php

namespace Modules\Client\Tests\Unit\Entities;

use Tests\TestCase;
use Modules\Client\Entities\Client;

class ClientTest extends TestCase
{
    protected $client;

    protected function setup(): void
    {
        parent::setUp();

        $this->client = new Client();
    }

    /**
     * @dataProvider activeAttributeDataProvider
     */
    public function test_it_formats_active_attribute($value, $expected_result)
    {
        $this->client->active = $value;

        $this->assertEquals($this->client->formatted_active, $expected_result);
    }

    /**
     * @dataProvider genreAttributeDataProvider
     */
    public function test_it_formats_genre_attribute($value, $expected_result)
    {
        $this->client->genre = $value;

        $this->assertEquals($this->client->formatted_genre, $expected_result);
    }

    public function test_it_formats_price_attribute()
    {
        $this->client->price = '1.000,00';

        $this->assertEquals('1.000,00', $this->client->formatted_price);
    }

    public function test_it_formats_date_birthday_attribute()
    {
        $this->client->date_birthday = '2021-10-19';

        $this->assertEquals($this->client->formatted_date_birthday, '19/10/2021');
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

    public function genreAttributeDataProvider()
    {
        yield 'formatted_genre deve retornar Feminino' => [
            'value' => Client::FEMALE,
            'expected_result' => 'Feminino'
        ];

        yield 'formatted_genre deve retornar Masculino' => [
            'value' => Client::MALE,
            'expected_result' => 'Masculino'
        ];
    }
}
