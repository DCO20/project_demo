<?php

use Modules\Country\Http\Controllers\CountryController;

Route::group([
    'prefix' => 'dashboard/pais',
    'as' => 'country.'
], function () {

    Route::get('/', [CountryController::class, 'index'])
        ->name('index');

    Route::get('/datatable', [CountryController::class, 'dataTable'])
        ->name('datatable');

    Route::get('/{id}/ver', [CountryController::class, 'show'])
        ->name('show');

    Route::get('/cadastrar', [CountryController::class, 'create'])
        ->name('create');

    Route::post('/cadastrar', [CountryController::class, 'store'])
        ->name('store');

    Route::get('/{id}/editar', [CountryController::class, 'edit'])
        ->name('edit');

    Route::put('/{id}/editar', [CountryController::class, 'update'])
        ->name('update');

    Route::get('/{id}/confirar-exclusao', [CountryController::class, 'confirmDelete'])
        ->name('confirmDelete');

    Route::delete('/{id}/excluir', [CountryController::class, 'destroy'])
        ->name('destroy');
});
