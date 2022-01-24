<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', 'PageController@index');

Route::get('/auth/redirect', 'SocialController@redirect')->name('social.redirect');
Route::get('/auth/callback', 'SocialController@callback')->name('social.callback');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', 'PageController@dashboard')->name('dashboard');

    Route::resource('users', 'UserController')->except(['create', 'store']);
});

require __DIR__ . '/auth.php';
