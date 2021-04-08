<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecipientListController;

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

//Route::get('/', 'HomeController@index');
Route::get('/', [HomeController::class, 'index']);
//debug
Route::get('/statistics', function() {
    return view('dashboard.statistics');
});

Auth::routes();
Route::get('/funds/add', [DashboardController::class, 'pay']);
Route::get('/funds', [DashboardController::class, 'funds']);
Route::get('/create', [DashboardController::class, 'index']);
Route::get('/drafts', [DashboardController::class, 'drafts']);
Route::get('/scheduled', [DashboardController::class, 'scheduled']);
Route::get('/recipients', [DashboardController::class, 'recipients']);
Route::get('/create/summary', [DashboardController::class, 'summary']);
Route::get('/recipients/add', [DashboardController::class, 'createRecipients']);
Route::post('/recipients/add', [RecipientListController::class, 'create'])->name('upload-list');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*Route::group(['middleware' => ['consumer', 'auth']], function () {
    //Gives the caller admin privileges
    Route::get('/consumer/m-m-a', 'AdminController@makeMeAdmin');

});*/
