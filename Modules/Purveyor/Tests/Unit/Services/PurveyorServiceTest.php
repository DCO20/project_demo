<?php

namespace Modules\Purveyor\Tests\Unit\Services;

use Modules\Purveyor\Entities\Purveyor;
use Modules\Purveyor\Services\PurveyorService;
use Tests\TestCase;

class PurveyorServiceTest extends TestCase
{
    protected $purveyor_service;

    protected function setup(): void
    {
        parent::setUp();

        $this->purveyor_service = new PurveyorService();
    }

    public function test_route_update_or_create_exception()
    {
        $this->expectException(\Exception::class);

        $this->purveyor_service->updateOrCreate([]);
    }

    public function test_route_remove_data_exception()
    {
        $this->expectException(\Exception::class);

        $purveyor = $this->mock(Purveyor::class);

        $this->purveyor_service->removeData($purveyor);
    }
}
