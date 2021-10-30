<?php

namespace Modules\Suit\Services;

use DB;
use Modules\Suit\Entities\Suit;
use Modules\Suit\Entities\SuitProduct;

class SuitService
{
	/*
	|--------------------------------------------------------------------------
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
	 * @return void
	 */
	public function updateOrCreate($request, $id = null)
	{
		DB::beginTransaction();

		try {
			$suit = $this->suit($request, $id);

			$this->removeProducts($request['remove_products_ids'] ?? []);

			$this->suitProducts($request['products'], $suit);

			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();

			abort(500);
		}
	}

	/**
	 * Remove o registro
	 *
	 * @param \Modules\Suit\Entities\Suit $suit
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


	/**
	 * Cadastra ou atualiza o Pedido
	 *
	 * @param array $request
	 * @param int|null $id
	 * @return Suit
	 */

	public function suit($request, $id)
	{
		$data = [
			'date' => $request['date'],
			'status' => $request['status'],
			'description' => $request['description'],
			'client_id' => $request['client_id']
		];

		return Suit::updateOrCreate([
			'id' => $id
		], $data);
	}

	public function suitProducts($products, $suit)
	{
		foreach ($products as $product) {
			$data = [
				'purveyor_id' => $product['purveyor_id'],
				'category_id' => $product['category_id'],
				'product_id' =>	$product['product_id'],
				'price'	=> $product['price'],
				'amount' => $product['amount']
			];

			$suit->suitProducts()->updateOrCreate([
				'id' => $product['id'] ?? null
			], $data);
		}
	}

	public function removeProducts($ids)
	{
		SuitProduct::whereIn('id', $ids)->delete();
	}
}
