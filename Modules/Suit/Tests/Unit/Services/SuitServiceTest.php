<?php

namespace Modules\Suit\Tests\Unit\Services;

use Modules\Suit\Entities\Suit;
use Modules\Suit\Services\SuitService;
use Tests\TestCase;

class SuitServiceTest extends TestCase
{
    protected $suit_service;

    protected function setup(): void
    {
        parent::setUp();

        $this->suit_service = new SuitService();
    }

    public function test_route_update_or_create_exception()
    {
        $this->expectException(\Exception::class);

        $this->suit_service->updateOrCreate([]);
    }

    public function test_route_remove_data_exception()
    {
        $this->expectException(\Exception::class);

        $suit = $this->mock(Suit::class);

        $this->suit_service->removeData($suit);
    }
}
