<?php

use Modules\Suit\Http\Controllers\SuitController;

Route::group(
	[
		'prefix' => 'dashboard/pedido',
		'as' => 'suit.'
	],
	function () {

		Route::get('/', [SuitController::class, 'index'])
			->name('index');

		Route::post('/datatable', [SuitController::class, 'dataTable'])
			->name('datatable');

		Route::get('/{id}/ver', [SuitController::class, 'show'])
			->name('show');

		Route::get('/cadastrar', [SuitController::class, 'create'])
			->name('create');

		Route::post('/cadastrar', [SuitController::class, 'store'])
			->name('store');

		Route::get('/{id}/editar', [SuitController::class, 'edit'])
			->name('edit');

		Route::put('/{id}/editar', [SuitController::class, 'update'])
			->name('update');

		Route::get('/{id}/confirmar-exclusao', [SuitController::class, 'confirmDelete'])
			->name('confirm_delete');

		Route::delete('/{id}/excluir', [SuitController::class, 'delete'])
			->name('delete');

		Route::post('/adicionar-fornecedor', [SuitController::class, 'addPurveyor'])
			->name('add_purveyor');

		Route::post('/categorias/carregamento-categorias', [SuitController::class, 'loadCategory'])
			->name('load_category');

		Route::post('/produtos/carregamento-produtos', [SuitController::class, 'loadProduct'])
			->name('load_product');
	}
);
