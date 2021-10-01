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
        Country::updateOrCreate(
            [
                'id' => $id
            ],
            $request
        );
    }
}
