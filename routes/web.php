<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('activity-sessions');
})->name('home');

Route::get('/categorias', function () {
    return view('category');
})->name('categories');

Route::get('/atividades', function () {
    return view('activities');
})->name('activities');

Route::get('/sessoes', function () {
    return view('activity-sessions');
})->name('activity-sessions');


Route::get('/relatorios', function () {
    return view('reports');
})->name('reports');