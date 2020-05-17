<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', "ApiController@awal")->name("awal");

// Auth::routes([
//     'register' => false, // Registration Routes...
//     'reset' => false, // Password Reset Routes...
//     'verify' => false, // Email Verification Routes...
// ]);
Route::get('/login', 'ApiController@login_form')->name('api.login_form');
Route::post('/login', 'ApiController@login')->name('api.login');
Route::get('/logout', 'ApiController@logout')->name('api.logout');


// Route::get('/buku', 'HomeController@index')->name('home')->middleware('auth');
// Route::get('/home', 'HomeController@index')->name('home2');
Route::get('/buku', 'HomeController@lihat_buku_dari_ci')->name('dari_ci');
Route::get('/buku/edit/{id}', 'HomeController@edit_buku_dari_ci_satu')->name('edit_dari_ci_satu');
Route::post('/buku/edit/{id}', 'HomeController@update_buku_dari_ci_satu')->name('update_dari_ci_satu');
Route::get('/buku/tambah', 'HomeController@tambah_buku_dari_ci')->name('tambah_dari_ci_satu');
Route::post('/buku/tambah', 'HomeController@simpan_buku_dari_ci_satu')->name('simpan_dari_ci_satu');
Route::get('/buku/hapus/{id}', 'HomeController@hapus_buku_dari_ci_satu')->name('hapus_dari_ci_satu');
Route::post('/buku/hapus/{id}', 'HomeController@delete_buku_dari_ci_satu')->name('delete_dari_ci_satu');
Route::get('/buku/{id}', 'HomeController@lihat_buku_dari_ci_satu')->name('dari_ci_satu');
// Route::get('/buku/edit/{id}', 'HomeController@edit_buku_dari_ci_satu')->name('edit_buku')->middleware('auth');
// Route::get('/buku/{id}', 'HomeController@lihat_buku')->name('lihat_buku')->middleware('auth');

Route::get('/user', 'UserController@index')->name('user');
Route::get('/user/tambah', 'UserController@tambah_user')->name('tambah_user');
Route::post('/user/tambah', 'UserController@add_user')->name('add_user');
Route::get('/user/edit/{id}', 'UserController@edit_user')->name('edit_user');
Route::post('/user/edit/{id}', 'UserController@update_user')->name('update_user');
Route::get('/user/hapus/{id}', 'UserController@hapus_user')->name('hapus_user');
Route::post('/user/hapus/{id}', 'UserController@delete_user')->name('delete_user');
// Route::get('/user/{id}', 'UserController@lihat_user')->name('lihat_user');






// Route::get('/debug', function () {
//     return dd(Auth::user()->level->id);
// })->name('debug')->middleware('auth');
