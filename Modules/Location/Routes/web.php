<?php

use Modules\Location\Http\Controllers\LocationController;

Route::group([
    'prefix' => 'dashboard/location',
    'as' => 'location.'
], function () {

    Route::get('/', [LocationController::class, 'index'])
        ->name('index');

    Route::post('/datatable', [LocationController::class, 'dataTable'])
        ->name('datatable');

    Route::get('/{id}/ver', [LocationController::class, 'show'])
        ->name('show');

    Route::get('/cadastrar', [LocationController::class, 'create'])
        ->name('create');

    Route::post('/cadastrar', [LocationController::class, 'store'])
        ->name('store');

    Route::get('/{id}/editar', [LocationController::class, 'edit'])
        ->name('edit');

    Route::put('/{id}/editar', [LocationController::class, 'update'])
        ->name('update');

    Route::get('/{id}/confirmar-exclusao', [LocationController::class, 'confirmDelete'])
        ->name('confirm_delete');

    Route::delete('/{id}/excluir', [LocationController::class, 'delete'])
        ->name('delete');
});