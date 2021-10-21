<?php

namespace Modules\Suit\Services;

use DB;
use Modules\Suit\Entities\Suit;

class SuitService
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
	 * @return \Modules\Suit\Entities\Suit
	 */
	public function updateOrCreate($request, $id = null)
	{
		DB::beginTransaction();

		try {
			$suit = Suit::updateOrCreate(['id' => $id], $request);

			$suit->clients()->sync($request['clients'] ?? []);

			DB::commit();

			return $suit;
		} catch (\Exception $e) {
			DB::rollBack();

			abort(500);
		}
	}

	/**
	 * Exclui e retorna a tela inicial
	 *
	 * @param \Modules\Suit\Entities\Suit $suit
	 *
	 * @return void
	 */
	public function removeData($suit)
	{
		DB::beginTransaction();

		try {
			$suit->delete();

			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();

			abort(500);
		}
	}
}
