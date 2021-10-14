<?php

namespace Modules\Product\Services;

use DB;
use Modules\Product\Entities\Product;

class ProductService
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
	 * @return \Modules\Product\Entities\Product
	 */
	public function updateOrCreate($request, $id = null)
	{
		DB::beginTransaction();

		try {

			$product = Product::updateOrCreate(['id' => $id], $request);

			$product->categories()->sync($request['categories'] ?? []);

			DB::commit();

			return $product;
		} catch (\Exception $e) {
			DB::rollBack();

			abort(500);
		}
	}

	/**
	 * Exclui e retorna a tela inicial
	 *
	 * @param \Modules\Product\Entities\Product $product
	 *
	 * @return void
	 */
	public function removeData($product)
	{
		DB::beginTransaction();

		try {

			$product->delete();

			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();

			abort(500);
		}
	}
}
