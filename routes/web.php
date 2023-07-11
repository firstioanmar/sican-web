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
    return view('welcome');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('/admin', function () {
    return view('dashboard');
});
Route::get('/ceritaku', function () {
    return view('ceritaku');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/halaman-baru', function () {
    return view('halaman-baru');
});
Route::get('/editceritaku', function () {
    return view('editceritaku');
});

Route::get('/edit', function () {
    return view('editprofile');
});
Route::get('/test', function () {
    return view('test');
});
