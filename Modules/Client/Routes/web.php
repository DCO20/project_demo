<?php

use Modules\Client\Http\Controllers\ClientController;

Route::group(
	[
		'prefix' => 'dashboard/cliente',
		'as' => 'client.',
		'middleware' => 'auth'
	],
	function () {

		Route::get('/', [ClientController::class, 'index'])
			->name('index');

		Route::post('/datatable', [ClientController::class, 'dataTable'])
			->name('datatable');

		Route::get('/{id}/ver', [ClientController::class, 'show'])
			->name('show');

		Route::get('/cadastrar', [ClientController::class, 'create'])
			->name('create');

		Route::post('/cadastrar', [ClientController::class, 'store'])
			->name('store');

		Route::get('/{id}/editar', [ClientController::class, 'edit'])
			->name('edit');

		Route::put('/{id}/editar', [ClientController::class, 'update'])
			->name('update');

		Route::get('/{id}/confirmar-exclusao', [ClientController::class, 'confirmDelete'])
			->name('confirm_delete');

		Route::delete('/{id}/excluir', [ClientController::class, 'delete'])
			->name('delete');
	}
);
