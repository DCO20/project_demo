<?php

namespace Modules\Suit\Tests\Unit\Http\Requests;

use Tests\TestCase;
use Modules\Suit\Http\Requests\SuitRequest;
use Modules\Suit\Http\Controllers\SuitController;

class SuitRequestTest extends TestCase
{
    protected $form_request;

    protected function setup(): void
    {
        parent::setUp();

        $this->form_request = new SuitRequest();
    }

    public function test_it_has_rules()
    {
        $rules = [
            'date' => 'required', 'date_format:m/d/Y',
            'status' => 'required',
            'products.*.category_id' => 'required',
            'products.*.product_id' => 'required',
            'products.*.purveyor_id' => 'required',
            'products.*.price' => 'required',
            'products.*.amount' => 'required', 'min:1'
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
        $this->assertActionUsesFormRequest(SuitController::class, $method, SuitRequest::class);
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
