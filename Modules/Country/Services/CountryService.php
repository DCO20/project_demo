<?php

namespace Modules\Country\Services;

use Modules\Country\Entities\Country;
use Modules\Country\Entities\Initial;

class CountryService
{
    /**
     * Método que cria um país
     * @param array $request
     * @param int|null $id
     *
     * @return void
     */
    public function updateOrCreate($request, $id = null)
    {
        $country = Country::updateOrCreate(['id' => $id], $request);

        $initial = [
            'country_id' => $country->id,
            'initial' => $request['initial']
        ];

        Initial::updateOrCreate(['id' => $id, $initial]);

    }
}
