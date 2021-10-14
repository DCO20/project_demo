<?php

use Modules\Product\Http\Controllers\ProductController;

Route::group(
	[
	'prefix' => 'dashboard/product',
	'as' => 'product.'
	],
	function () {

		Route::get('/', [ProductController::class, 'index'])
		->name('index');

		Route::post('/datatable', [ProductController::class, 'dataTable'])
		->name('datatable');

		Route::get('/{id}/ver', [ProductController::class, 'show'])
		->name('show');

		Route::get('/cadastrar', [ProductController::class, 'create'])
		->name('create');

		Route::post('/cadastrar', [ProductController::class, 'store'])
		->name('store');

		Route::get('/{id}/editar', [ProductController::class, 'edit'])
		->name('edit');

		Route::put('/{id}/editar', [ProductController::class, 'update'])
		->name('update');

		Route::get('/{id}/confirmar-exclusao', [ProductController::class, 'confirmDelete'])
		->name('confirm_delete');

		Route::delete('/{id}/excluir', [ProductController::class, 'delete'])
		->name('delete');
	}
);
