<?php

namespace Modules\Country\Services;

use Modules\Country\Entities\Country;

class CountryServices
{
    /**
     * Método que cria uma país
     * @param array $request
     * @param int|null $id
     *
     * @return void
     */
    public function register($request, $id = null)
    {
        Country::updateOrCreate(['id' => $id], $request);
    }
}
