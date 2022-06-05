<?php

namespace Modules\Suit\Presenter;

use App\Presenter\Presenter;

class SuitPresenter extends Presenter
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
	 * Obtém o label de ativo ou inativo
	 *
	 * @return string
	 */
	public function actionView()
	{
		return '<div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cog" aria-hidden="true"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="' . route('suit.show', $this->model->id) . '">Ver</a>
                <a class="dropdown-item" href="' . route('suit.edit', $this->model->id) . '">Editar</a>
                <a class="dropdown-item" href="' . route('suit.confirm_delete', $this->model->id) . '">Excluir</a>
                </div>';
	}

	/**
	 * calcula o total dos produtos
	 *
	 * @return string
	 */
	public function total()
	{
		$total = 0;

		foreach ($this->model->suitProducts as $item) {
			$total += $item->price * $item->amount;
		}

		return "R$ " . number_format($total, 2, ',', '.');
	}
}
