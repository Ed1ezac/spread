<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecipientListController;
use App\Http\Controllers\SMSController;

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

Auth::routes();
//sms
Route::get('/drafts', [DashboardController::class, 'drafts']);
Route::get('/create', [DashboardController::class, 'create']);
Route::get('/create/summary', [SMSController::class, 'summary']);
Route::post('/create/verify', [SMSController::class, 'verify']);
Route::post('/create/confirm', [SMSController::class, 'confirm']);
Route::get('/scheduled', [DashboardController::class, 'scheduled']);
Route::post('/create/save-as-draft', [SMSController::class, 'save']);
Route::post('/drafts/item/delete', [SMSController::class, 'deleteDraft']);
Route::post('/sms/rollout/abort', [SMSController::class, 'abortRollout']);
Route::post('/scheduled/sms/abort', [SMSController::class, 'abortScheduledRollout']);
Route::get('/scheduled/sms/{id?}/update', [SMSController::class, 'updateScheduledSms']);
Route::post('/scheduled/sms/send-now', [SMSController::class, 'processScheduledRolloutNow']);
//funds
Route::get('/funds/add', [FundsController::class, 'pay']);
Route::get('/funds', [DashboardController::class, 'funds']);
//recipients
Route::get('/recipients', [DashboardController::class, 'recipients']);
Route::get('/recipients/add', [DashboardController::class, 'createRecipients']);
Route::get('/recipients/{id?}/download', [RecipientListController::class, 'download']);
Route::post('/recipients/item/delete', [RecipientListController::class, 'deleteList']);
Route::post('/recipients/add', [RecipientListController::class, 'create'])->name('upload-list');
//stats
Route::get('/statistics', [DashboardController::class, 'statistics']);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/*Route::group(['middleware' => ['consumer', 'auth']], function () {
    //Gives the caller admin privileges
    Route::get('/consumer/m-m-a', 'AdminController@makeMeAdmin');
});*/
