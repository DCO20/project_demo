<?php

namespace Modules\Client\Services;

use DB;
use Modules\Client\Entities\Client;

class ClientService
{
	/*--------------------------------------------------------------------------
	| Main Function
	|--------------------------------------------------------------------------
	|
	| Métodos principais do CRUD.
	| Define os métodos e as regras de negócio relacionadas ao CRUD.
	|
	*/

	/**
	 * Cadastra ou atualiza o registro
	 *
	 * @param array $request
	 * @param int|null $id
	 *
	 * @return void
	 */
	public function updateOrCreate($request, $id = null)
	{
		DB::beginTransaction();

		try {
			Client::updateOrCreate(['id' => $id], $request);

			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();

			abort(500);
		}
	}

	/**
	 * Exclui e retorna a tela inicial
	 *
	 * @param \Modules\Client\Entities\Client $client
	 *
	 * @return void
	 */
	public function removeData($client)
	{
		DB::beginTransaction();

		try {
			$client->delete();

			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();

			abort(500);
		}
	}
}
