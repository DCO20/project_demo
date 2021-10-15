<?php

use Modules\Purveyor\Http\Controllers\PurveyorController;

Route::group(
    [
        'prefix' => 'dashboard/purveyor',
        'as' => 'purveyor.'
    ],
    function () {

        Route::get('/', [PurveyorController::class, 'index'])
            ->name('index');

        Route::post('/datatable', [PurveyorController::class, 'dataTable'])
            ->name('datatable');

        Route::get('/{id}/ver', [PurveyorController::class, 'show'])
            ->name('show');

        Route::get('/cadastrar', [PurveyorController::class, 'create'])
            ->name('create');

        Route::post('/cadastrar', [PurveyorController::class, 'store'])
            ->name('store');

        Route::get('/{id}/editar', [PurveyorController::class, 'edit'])
            ->name('edit');

        Route::put('/{id}/editar', [PurveyorController::class, 'update'])
            ->name('update');

        Route::get('/{id}/confirmar-exclusao', [PurveyorController::class, 'confirmDelete'])
            ->name('confirm_delete');

        Route::delete('/{id}/excluir', [PurveyorController::class, 'delete'])
            ->name('delete');
    }
);
