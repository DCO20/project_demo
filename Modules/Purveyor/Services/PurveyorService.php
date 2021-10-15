<?php

namespace Modules\Purveyor\Services;

use DB;
use Modules\Purveyor\Entities\Purveyor;

class PurveyortService
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
	 * @return \Modules\Purveyor\Entities\Purveyor
	 */
	public function updateOrCreate($request, $id = null)
	{
		DB::beginTransaction();

		try {

			Purveyor::updateOrCreate(['id' => $id], $request);

			DB::commit();

		} catch (\Exception $e) {
			DB::rollBack();

			abort(500);
		}
	}

	/**
	 * Exclui e retorna a tela inicial
	 *
	 * @param \Modules\Purveyor\Entities\Purveyor $purveyor
	 *
	 * @return void
	 */
	public function removeData($purveyor)
	{
		DB::beginTransaction();

		try {

			$purveyor->delete();

			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();

			abort(500);
		}
	}
}
