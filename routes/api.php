<?php

use App\Http\Controllers\AuthUserController;
use Modules\Product\Http\Controllers\ApiProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/auth/token', [AuthUserController::class, 'auth'])
	->name('auth');

Route::group(
	[
		'middleware' => ['auth:sanctum']
	],
	function () {
		Route::apiResource('products', ApiProductController::class);

		Route::post('auth/logout', [AuthUserController::class, 'logout']);
	}
);

Route::get('/', function () {
	return response()->json(['message' => 'ok']);
});
