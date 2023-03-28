<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ajaxController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TempController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\SerNoController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\ReceiveController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\EstablishmentController;

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
    Route::get('issue/approve',[IssueController::class,'issue_approve_issue'])->name('issue.approve');
    Route::get('issue/forward_view/{issue}',[IssueController::class,'issue_forward_view'])->name('issue.forward_view');
    Route::put('issue/forward/{issue}',[IssueController::class,'issue_forward'])->name('issue.forward');
    Route::get('issue/return/{issue}',[IssueController::class,'issue_return'])->name('issue.return');
    Route::resource('issue', IssueController::class);
    Route::resource('stock', StockController::class);
    Route::resource('temp', TempController::class);
    Route::get('item/add_unit_item_view',[ItemController::class,'add_unit_item_view'])->name('item.add_unit_item_view');
    Route::get('item/add_unit_item/{item}',[ItemController::class,'add_unit_item'])->name('item.add_unit_item');
    Route::get('item/add_unit_remove/{item}/{id}',[ItemController::class,'add_unit_remove'])->name('item.add_unit_remove');
    Route::post('item/add_unit/{item}',[ItemController::class,'add_unit'])->name('item.add_unit');
    Route::resource('item', ItemController::class);
    Route::resource('purchase', PurchaseController::class);
    Route::resource('vote', VoteController::class);
    Route::resource('title', TitleController::class);
    Route::resource('serno', SerNoController::class);
    Route::prefix('settings')->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
    });
});

Route::get('/ajax/getTitle', [ajaxController::class, 'getTitle'])->name('ajax.getTitle');
Route::get('/ajax/getItemCode', [ajaxController::class, 'getItemCode'])->name('ajax.getItemCode');
Route::get('/titles/search', [TitleController::class, 'search'])->name('titles.search');
Route::get('/get-item-serial/{itemCode}', [ajaxController::class, 'getItemSerial'])->name('ajax.getItemSerial');
