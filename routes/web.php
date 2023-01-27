<?php

use App\Http\Controllers\ajaxController;
use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReceiveController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('profile');
    Route::post('/profile', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('update-password');
    Route::resource('establishment', EstablishmentController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('receive', ReceiveController::class);
    Route::resource('item', ItemController::class);
    Route::resource('purchase', PurchaseController::class);
    Route::resource('vote', VoteController::class);
    Route::resource('title', TitleController::class);
    Route::prefix('settings')->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
    });
});

Route::get('/ajax/getTitle', [ajaxController::class, 'getTitle'])->name('ajax.getTitle');
Route::get('/ajax/getItemCode', [ajaxController::class, 'getItemCode'])->name('ajax.getItemCode');
