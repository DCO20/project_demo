<?php

namespace Modules\Provider\Services;

use Illuminate\Support\Facades\DB;
use Modules\Provider\Entities\Provider;

class ProviderService
{
    /**
     * Método que cria um produto
     * @param array $request
     * @param int|null $id
     *
     * @return void
     */
    public function updateOrCreate($request, $id = null)
    {
        DB::beginTransaction();

        try {
            Provider::updateOrCreate(['id' => $id], $request);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500);
        }
    }


    /**
     * Exclui e retorna a tela inicial
     * @param Modules\Provider\Entities\Provider $Provider
     * @param int|null $id
     *
     * @return void
     */
    public function removeData($provider)
    {
        DB::beginTransaction();

        try {
            $provider->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500);
        }
    }
}
