<?php

namespace Modules\Country\Services;

use Modules\Country\Entities\Initial;

class InitialService
{
    /**
     * Método que cria uma sigla
     * @param array $request
     * @param int|null $id
     *
     * @return void
     */
    public function updateOrCreate($request, $id)
    {
        $initial = [
            'country_id' => $request['country_id'],
            'name' => $request['name']
        ];

        Initial::updateOrCreate(['id' => $id, $initial]);
    }
}
