<?php

namespace Modules\Product\Tests\Unit\Http\Requests;

use Tests\TestCase;
use Modules\Product\Http\Requests\ProductRequest;
use Modules\Product\Http\Controllers\ProductController;

class ProductRequestTest extends TestCase
{
    protected $form_request;

    protected function setup(): void
    {
        parent::setUp();

        $this->form_request = new ProductRequest();
    }

    public function test_it_has_rules()
    {
        $rules = [
            'name' => 'required',
            'price' => 'required',
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
        $this->assertActionUsesFormRequest(ProductController::class, $method, ProductRequest::class);
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
