<?php

namespace Modules\Client\Tests\Unit\Http\Requests;

use Tests\TestCase;
use Modules\Client\Http\Requests\ClientRequest;
use Modules\Client\Http\Controllers\ClientController;

class ClientRequestTest extends TestCase
{
    protected $form_request;

    protected function setup(): void
    {
        parent::setUp();

        $this->form_request = new ClientRequest();
    }

    public function test_it_has_rules()
    {
        $rules = [
            'name' => 'required',
            'price' => 'required',
            'date_birthday' => 'required',
            'genre' => 'required',
            'active' => 'required'
        ];

        $this->assertEquals($rules,  $this->form_request->rules());
    }

    public function test_it_has_authorize()
    {
        $this->assertTrue($this->form_request->authorize());
    }

    /**
     * @dataProvider methodsDataProvider
     */
    public function test_it_has_form_request($method)
    {
        $this->assertActionUsesFormRequest(ClientController::class, $method, ClientRequest::class);
    }

    public function methodsDataProvider()
    {
        yield [
            'store'
        ];

        yield [
            'update'
        ];
    }
}
