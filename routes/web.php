<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FundsController;
use App\Http\Controllers\ReserveController;
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

Route::get('/', [SiteController::class, 'landing']);

Auth::routes();
//sms
Route::get('/drafts', [DashboardController::class, 'drafts']);
Route::get('/create', [DashboardController::class, 'create']);
Route::post('/create/verify', [SMSController::class, 'verify']);
Route::post('/create/sms/update', [SMSController::class, 'update']);
Route::get('/scheduled', [DashboardController::class, 'scheduled']);
Route::post('/create/confirm', [SMSController::class, 'createAndQueue']);
Route::post('/create/save-as-draft', [SMSController::class, 'saveDraft']);
Route::post('/drafts/item/delete', [SMSController::class, 'deleteDraft']);
Route::post('/sms/rollout/abort', [SMSController::class, 'abortRollout']);
Route::get('/create/summary/{recipientsId?}', [SMSController::class, 'summary']);
Route::post('/scheduled/sms/abort', [SMSController::class, 'abortScheduledRollout']);
Route::get('/scheduled/sms/{id?}/update', [SMSController::class, 'updateScheduledSms']);
Route::post('/scheduled/sms/send-now', [SMSController::class, 'processScheduledRolloutNow']);
//funds
Route::get('/funds/add', [FundsController::class, 'pay'])->middleware('auth');
Route::get('/funds', [DashboardController::class, 'funds']);
Route::post('/funds/buy', [FundsController::class, 'buyFunds']);
//recipients
Route::get('/recipients', [DashboardController::class, 'recipients']);
Route::get('/recipients/add', [RecipientListController::class, 'createRecipients']);
Route::get('/recipients/{id?}/download', [RecipientListController::class, 'download']);
Route::post('/recipients/item/delete', [RecipientListController::class, 'deleteList']);
Route::post('/recipients/add', [RecipientListController::class, 'create'])->name('upload-list');
//stats
Route::get('/statistics', [DashboardController::class, 'statistics']);

Route::group(['prefix' =>'admin', 'middleware' =>'admin'], function () {
    //admin privileged
    Route::get('/funds-reserve', [AdminController::class, 'fundsReserve']);
    //Route::get('/tasks', [AdminController::class, '']);
    //Route::get('/spread-websockets');
});
Route::get('/user/challenge/admin/get-role', [AdminController::class, 'createFirstSuperAdmin'])->middleware('auth');
