<?php

use Modules\Provider\Http\Controllers\ProviderController;

Route::group([
    'prefix' => 'dashboard/provider',
    'as' => 'provider.'
], function () {

    Route::get('/', [ProviderController::class, 'index'])
        ->name('index');

    Route::post('/datatable', [ProviderController::class, 'dataTable'])
        ->name('datatable');

    Route::post('/cidade/carregamento-cidades', [ProviderController::class, 'loadCity'])
        ->name('loadcity');

    Route::get('/{id}/ver', [ProviderController::class, 'show'])
        ->name('show');

    Route::get('/cadastrar', [ProviderController::class, 'create'])
        ->name('create');

    Route::post('/cadastrar', [ProviderController::class, 'store'])
        ->name('store');

    Route::get('/{id}/editar', [ProviderController::class, 'edit'])
        ->name('edit');

    Route::put('/{id}/editar', [ProviderController::class, 'update'])
        ->name('update');

    Route::get('/{id}/confirmar-exclusao', [ProviderController::class, 'confirmDelete'])
        ->name('confirm_delete');

    Route::delete('/{id}/excluir', [ProviderController::class, 'delete'])
        ->name('delete');
});
