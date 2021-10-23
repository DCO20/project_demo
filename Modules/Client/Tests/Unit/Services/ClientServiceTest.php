<?php

namespace Modules\Client\Tests\Unit\Services;

use Modules\Client\Entities\Client;
use Modules\Client\Services\ClientService;
use Tests\TestCase;

class ClientServiceTest extends TestCase
{
    protected $client_service;

    protected function setup(): void
    {
        parent::setUp();

        $this->client_service = new ClientService();
    }

    public function test_route_update_or_create_exception()
    {
        $this->expectException(\Exception::class);

        $this->client_service->updateOrCreate([]);
    }

    public function test_route_remove_data_exception()
    {
        $this->expectException(\Exception::class);

        $client = $this->mock(Client::class);

        $this->client_service->removeData($client);
    }
}
