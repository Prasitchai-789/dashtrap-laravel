<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\HRE\Employee;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RPO\PalmPurchase;
use App\Http\Controllers\RPO\ProductSale;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/test', [Controller::class, 'testLive'])->name('test');
Route::get('/starter', [Controller::class, 'starterPage'])->name('starter');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::group(['middleware' => ['auth','role:developer|admin']], function () {
    Route::resource('permissions', PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

    Route::resource('roles', RoleController::class);
    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);

    Route::resource('users', UserController::class);
    Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);
});

Route::group(['middleware' => ['auth','role:developer|admin']], function () {
    Route::get('/palm-purchase', [PalmPurchase::class, 'palmPurchase'])->name('palm-purchase');
    Route::get('/product-sale', [ProductSale::class, 'productSale'])->name('product-sale');
});

Route::group(['middleware' => ['auth','role:developer|admin']], function () {
    Route::get('/employee', [Employee::class, 'employee'])->name('employee');
});


require __DIR__ . '/auth.php';
