<?php

namespace Modules\State\Services;

use Modules\State\Entities\State;

class StateService
{
    /**
     * Método que cria um estado
     * @param array $request
     * @param int|null $id
     *
     * @return void
     */
    public function updateOrCreate($request, $id = null)
    {
        State::updateOrCreate(
            [
                'id' => $id
            ],
            $request
        );
    }
}
