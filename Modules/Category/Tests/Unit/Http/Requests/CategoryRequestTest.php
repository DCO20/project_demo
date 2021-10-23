<?php

namespace Modules\Category\Tests\Unit\Http\Requests;

use Tests\TestCase;
use Modules\Category\Http\Requests\CategoryRequest;
use Modules\Category\Http\Controllers\CategoryController;

class CategoryRequestTest extends TestCase
{
    protected $form_request;

    protected function setup(): void
    {
        parent::setUp();

        $this->form_request = new CategoryRequest();
    }

    public function test_it_has_rules()
    {
        $rules = [
            'name' => 'required',
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
        $this->assertActionUsesFormRequest(CategoryController::class, $method, CategoryRequest::class);
    }

    public function methodsDataProvider()
    {
        yield[
            'store'
        ];

        yield[
            'update'
        ];
    }
}
