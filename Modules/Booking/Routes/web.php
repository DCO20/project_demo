<?php

use Illuminate\Support\Facades\Route;
use Modules\Booking\Http\Controllers\BookingController;

Route::group(
	[
		'prefix' => 'dashboard/reserva',
		'as' => 'booking.'
	],
	function () {

		Route::get('/', [BookingController::class, 'index'])
			->name('index');
	}
);
