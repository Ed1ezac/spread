<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FundsController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SenderNamesController;
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
Auth::routes(['verify'=>true]);
Route::get('/', [SiteController::class, 'landing']);
//Route::get('/faqs', [SiteController::class, 'faqs']);
Route::get('/terms', [SiteController::class, 'terms']);
Route::get('/refunds', [SiteController::class, 'refunds']);
Route::get('/privacy', [SiteController::class, 'privacy']);
Route::get('/learn-more', [SiteController::class, 'learnMore']);

Route::middleware(['auth', 'verified'])->group(function () {
//user
Route::get('/settings', [UserController::class, 'userSettings']);
Route::post('/settings/update/security', [UserController::class, 'updateSecurity']);
Route::post('/settings/update/personal-info', [UserController::class, 'updatePersonalInfo']);
Route::get('/settings/register/new/sender-name', [SenderNamesController::class, 'registerName']);
Route::post('/settings/register/new/sender-name', [SenderNamesController::class,'createName'])->name('register-sender-name');
Route::post('/settings/delete/sender-name', [SenderNamesController::class, 'deleteName'])->name('delete-sender-name');
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
Route::post('/scheduled/sms/abort', [SMSController::class, 'abortScheduledRollout']);
Route::get('/scheduled/sms/{id?}/update', [SMSController::class, 'updateScheduledSms']);
Route::get('/create/sms/for/{recipientsId?}/summary/', [SMSController::class, 'summary']);
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
Route::get('/statistics/view/sms/{id?}', [SMSController::class, 'viewSms']);
});

//----Administration-----
Route::group(['prefix' =>'admin', 'middleware' =>'admin'], function () {
    //admin privileged
    Route::get('/funds-reserve', [AdminController::class, 'reserve']);
    Route::get('/funds-reserve/create', [AdminController::class, 'makeReserve']);
    Route::get('/funds-reserve/edit', [ReserveController::class, 'editReserve']);
    Route::post('/funds-reserve/create/new', [AdminController::class, 'createReserve']);
    Route::post('funds-reserve/credit/funds', [ReserveController::class, 'creditReserve']);
    Route::post('/funds-reserve/deduct/funds', [ReserveController::class, 'deductFromReserve']);
    //sms
    Route::get('/smses', [AdminController::class, 'smses']);
    //orange-info
    Route::get('/orange-info', [AdminController::class, 'orangeInfo']);
    Route::get('/orange-info/test-sms', [AdminController::class, 'testSms']);
    Route::post('/send/test-sms', [AdminController::class, 'sendTestSms']);
    //senderName
    Route::get('/sender-names', [SenderNamesController::class, 'getNames']);
    Route::get('/sender-names/{id?}/details', [SenderNamesController::class, 'senderNameDetails']);
    Route::post('sender-name/edit/status/positive', [SenderNamesController::class, 'updateStatus']);
    Route::post('sender-name/edit/status/negative', [SenderNamesController::class, 'rejectName']);
    //users
    Route::get('/users', [AdminController::class, 'users']);
    Route::get('/users/user/{id?}/edit/funds', [AdminController::class, 'editUserFunds']);
    Route::get('/users/user/{id?}/edit/roles', [AdminController::class, 'editUserRoles']);
    //Route::get('users/user/{id?}/suspend', [AdminController::class, 'suspendUser']);
    Route::post('/user/deduct/funds', [AdminController::class, 'deductUserFunds']);
    Route::post('/user/credit/funds', [AdminController::class, 'creditUserFunds']);
    Route::post('/user/add/role', [AdminController::class, 'assignRole']);
    Route::post('/user/remove/role', [AdminController::class, 'removeRole']);
    //tasks
    Route::get('/files', [AdminController::class, 'files']);
    Route::get('/rollout-tasks', [AdminController::class, 'tasks']);
    Route::post('/rollout-tasks/abort', [AdminController::class, 'killTask']);
    Route::get('/rollout-tasks/view/task/{id?}', [AdminController::class, 'viewTask']);
});
Route::get('/user/challenge/admin/get-role', [AdminController::class, 'createFirstSuperAdmin'])->middleware(['auth', 'verified']);
