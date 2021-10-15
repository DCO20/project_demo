<?php

use Modules\Category\Http\Controllers\CategoryController;

Route::group(
	[
	'prefix' => 'dashboard/categoria',
	'as' => 'category.'
	],
	function () {

		Route::get('/', [CategoryController::class, 'index'])
		->name('index');

		Route::post('/datatable', [CategoryController::class, 'dataTable'])
		->name('datatable');

		Route::get('/{id}/ver', [CategoryController::class, 'show'])
		->name('show');

		Route::get('/cadastrar', [CategoryController::class, 'create'])
		->name('create');

		Route::post('/cadastrar', [CategoryController::class, 'store'])
		->name('store');

		Route::get('/{id}/editar', [CategoryController::class, 'edit'])
		->name('edit');

		Route::put('/{id}/editar', [CategoryController::class, 'update'])
		->name('update');

		Route::get('/{id}/confirmar-exclusao', [CategoryController::class, 'confirmDelete'])
		->name('confirm_delete');

		Route::delete('/{id}/excluir', [CategoryController::class, 'delete'])
		->name('delete');
	}
);
