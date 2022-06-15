<?php

use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
	return redirect()->route('login');
});

Route::get('/login/google', [LoginController::class,'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [LoginController::class,'handleGoogleCallback']);

Route::get('/login/facebook', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);

Route::get('/login/github', [LoginController::class, 'redirectToGithub'])->name('login.github');
Route::get('/login/github/callback', [LoginController::class, 'handleGithubCallback']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
