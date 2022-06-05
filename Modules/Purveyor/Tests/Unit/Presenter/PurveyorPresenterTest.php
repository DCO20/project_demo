<?php

namespace Modules\Purveyor\Tests\Unit\Presenter;

use Tests\TestCase;
use Modules\Purveyor\Entities\Purveyor;

class PurveyorPresenterTest extends TestCase
{
    public function test_it_gets_action_view()
    {
        $purveyor = new Purveyor();

        $purveyor->id = 123;

        $this->assertStringContainsString($purveyor->id, $purveyor->actionView());
    }
}
