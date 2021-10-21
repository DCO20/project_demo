<?php

namespace Modules\Client\Tests\Unit\Presenter;

use Tests\TestCase;
use Modules\Client\Entities\Client;

class ClientPresenterTest extends TestCase
{
    public function test_it_gets_action_view()
    {
        $client = new Client();

        $client->id = 123;

        $this->assertStringContainsString($client->id, $client->actionView());
    }
}
