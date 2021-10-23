<?php

namespace Modules\Suit\Tests\Unit\Presenter;

use Tests\TestCase;
use Modules\Suit\Entities\Suit;

class SuitPresenterTest extends TestCase
{
    public function test_it_gets_action_view()
    {
        $Suit = new Suit();

        $Suit->id = 123;

        $this->assertStringContainsString($Suit->id, $Suit->actionView());
    }
}
