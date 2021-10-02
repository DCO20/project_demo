<?php

namespace Modules\Location\Services;

use Modules\Location\Entities\Location;

class LocationService
{
    /**
     * Método que cria uma localização
     * @param array $request
     * @param int|null $id
     *
     * @return void
     */
    public function updateOrCreate($request, $id = null)
    {
        Location::updateOrCreate(
            [
                'id' => $id
            ],
            $request
        );
    }
}
