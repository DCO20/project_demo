<?php

namespace Modules\Provider\Services;

use Illuminate\Support\Facades\DB;
use Modules\Provider\Entities\Address;
use Modules\Provider\Entities\Contact;
use Modules\Provider\Entities\Provider;

class ProviderService
{
    /**
     * Método que cria um fornecedor
     * @param array $request
     * @param int|null $id
     *
     * @return void
     */
    public function updateOrCreate($request, $id = null)
    {
        DB::beginTransaction();

        try {
            $provider = Provider::updateOrCreate(['id' => $id], $request);

            $data = [
                'provider_id' => $provider->id,
                'phone_cell' => $request['phone_cell'],
                'email' => $request['email']
            ];

            Contact::updateOrCreate(['id' => $provider->contacts->id ?? null], $data);

            $data = [
                'provider_id' => $provider->id,
                'city_id' => $request['city_id'],
                'zipcode' => $request['zipcode'],
                'street' => $request['street'],
                'number' => $request['number'],
                'complement' => $request['complement'],
                'district' => $request['district'],
                'ref_point' => $request['ref_point']
            ];

            Address::updateOrCreate(['id' => $provider->address->id ?? null], $data);

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
