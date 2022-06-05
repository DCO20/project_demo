<?php

namespace Modules\Purveyor\Tests\Unit\Http\Requests;

use Tests\TestCase;
use Modules\Purveyor\Http\Requests\PurveyorRequest;
use Modules\Purveyor\Http\Controllers\PurveyorController;

class PurveyorRequestTest extends TestCase
{
    protected $form_request;

    protected function setup(): void
    {
        parent::setUp();

        $this->form_request = new PurveyorRequest();
    }

    public function test_it_has_rules()
    {
        $rules = [
            'name' => 'required',
            'cnpj' => 'required',
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
        $this->assertActionUsesFormRequest(PurveyorController::class, $method, PurveyorRequest::class);
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
