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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
// Route::get('/', 'HomeController@index');
Route::get('/auth/google', 'Auth\LoginController@redirectToProvider');
Route::get('/google_callback', 'Auth\LoginController@handleProviderCallback');
Route::middleware(['is_user'])->group(function () {
    Route::get('/', 'HomeController@index');

        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/profile', 'HomeController@profile')->name('profile');
        Route::post('/update/profile', 'HomeController@updateProfile')->name('update-profile');
      
});

Route::middleware(['is_admin'])->prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin');    
    Route::get('/get/users/records', 'AdminController@getUsersRecords')->name('user_records');    

});
