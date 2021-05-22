<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// KLIENTAS
Route::get('/Klientai/{type?}', [App\Http\Controllers\Controller::class, 'Klientas'])->name('Klientas');


Route::post('ajaxRequest', [App\Http\Controllers\Controller::class, 'send'])->name('send');


Route::get('/register_klientas', [App\Http\Controllers\Controller::class, 'register_klientas'])->name('register_klientas');
Route::post('/register_klientas', [App\Http\Controllers\Controller::class, 'register_klientas_post'])->name('register_klientas_post');

Route::get('/update_klientas/{id}', [App\Http\Controllers\Controller::class, 'update_klientas'])->name('update_klientas');
Route::post('/update_klientas/{id}', [App\Http\Controllers\Controller::class, 'update_klientas_post'])->name('update_klientas_post');

Route::get('/delete_klientas/{id}', [App\Http\Controllers\Controller::class, 'delete_klientas'])->name('delete_klientas');



// SABLONAS
Route::get('/Sablonai', [App\Http\Controllers\Controller::class, 'Sablonas'])->name('Sablonas');

Route::get('/register_sablonas', [App\Http\Controllers\Controller::class, 'register_sablonas'])->name('register_sablonas');
Route::post('/register_sablonas', [App\Http\Controllers\Controller::class, 'register_sablonas_post'])->name('register_sablonas_post');

Route::get('/update_sablonas/{id}', [App\Http\Controllers\Controller::class, 'update_sablonas'])->name('update_sablonas');
Route::post('/update_sablonas/{id}', [App\Http\Controllers\Controller::class, 'update_sablonas_post'])->name('update_sablonas_post');

Route::get('/delete_sablonas/{id}', [App\Http\Controllers\Controller::class, 'delete_sablonas'])->name('delete_sablonas');

// SUPLANUOTI
Route::get('/Suplanuoti', [App\Http\Controllers\Controller::class, 'Suplanuoti'])->name('Suplanuoti');
Route::get('/delete_suplanuotas/{id}', [App\Http\Controllers\Controller::class, 'delete_suplanuotas'])->name('delete_suplanuotas');
