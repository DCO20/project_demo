<?php

namespace Modules\Country\Services;

use Modules\Country\Entities\Country;

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

        (new InitialService)->updateOrCreate($request, $country->initial->id ?? null);
    }
}
