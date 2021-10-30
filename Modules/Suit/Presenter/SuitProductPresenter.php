<?php

namespace Modules\Suit\Presenter;

use App\Presenter\Presenter;

class SuitProductPresenter extends Presenter
{
	/*
	|--------------------------------------------------------------------------
	| Function View
	|--------------------------------------------------------------------------
	|
	| Definições dos métodos relacionados as regras de negócio.
	| Métodos que definem a formatação dos dados que serão apresentados na view.
	|
	*/

	/**
	 * calcula o produto
	 *
	 * @return string
	 */
	public function total()
	{
		$total = $this->model->price * $this->model->amount;

		return "R$ " . number_format($total, 2, ',', '.');
	}
}
