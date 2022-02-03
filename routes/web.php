<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//admin Routes
Route::post('log/admin','AdminController@log_admin')->name('log.admin');
Route::post('register/admin','AdminController@register_admin')->name('register.admin');

//finished
Route::get('admin/login','AdminController@admin_login')->name('admin.login');//view adminLogin
Route::get('admin/register','AdminController@admin_register')->name('admin.register')->middleware('auth:admin');//view admin_register
Route::get('dash','AdminController@dash')->name('dash')->middleware('auth:admin');//dash

//one to one

Route::get('user/{id}/phone', function ($id){

    $user = User::find($id)->phone->phone;//name of column

    return $user;
});
