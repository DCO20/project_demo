<?php

use Modules\Country\Http\Controllers\CountryController;

Route::group([
    'prefix' => 'countries',
    'as' => 'countries.'
], function () {

    Route::get('/datatable', [CountryController::class, 'dataTable'])->name('datatable');
    Route::delete('/destroy/{id}', [CountryController::class, 'destroy'])->name('destroy');
    Route::put('/edit/{id}', [CountryController::class, 'update'])->name('update');
    Route::get('/edit/{id}', [CountryController::class, 'edit'])->name('edit');
    Route::get('/show/{id}', [CountryController::class, 'show'])->name('show');
    Route::post('/create', [CountryController::class, 'store'])->name('store');
    Route::get('/create', [CountryController::class, 'create'])->name('create');
    Route::get('/', [CountryController::class, 'index'])->name('index');
});
