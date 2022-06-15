<?php

Route::get('/', function () {
	return redirect()->route('client.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
