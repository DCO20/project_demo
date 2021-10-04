<?php

use Modules\State\Http\Controllers\StateController;

Route::group([
    'prefix' => 'dashboard/state',
    'as' => 'state.'
], function () {

    Route::get('/', [StateController::class, 'index'])
        ->name('index');

    Route::post('/datatable', [StateController::class, 'dataTable'])
        ->name('datatable');

    Route::get('/{id}/ver', [StateController::class, 'show'])
        ->name('show');

    Route::get('/cadastrar', [StateController::class, 'create'])
        ->name('create');

    Route::post('/cadastrar', [StateController::class, 'store'])
        ->name('store');

    Route::get('/{id}/editar', [StateController::class, 'edit'])
        ->name('edit');

    Route::put('/{id}/editar', [StateController::class, 'update'])
        ->name('update');

    Route::get('/{id}/confirmar-exclusao', [StateController::class, 'confirmDelete'])
        ->name('confirm_delete');

    Route::delete('/{id}/excluir', [StateController::class, 'delete'])
        ->name('delete');
});
