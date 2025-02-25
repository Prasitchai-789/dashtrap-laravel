<?php

use App\Http\Controllers\ACC\PurchasePriceController;
use App\Http\Controllers\CAR\CarController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\GraphTotalPalmController;
use App\Http\Controllers\Dashboard\TableTotalPalmController;
use App\Http\Controllers\HRE\Employee;
use App\Http\Controllers\CAR\UseCarController;
use App\Http\Controllers\Dashboard\GraphController;
use App\Http\Controllers\MAR\SalesPlanController;
use App\Http\Controllers\RPO\AveragePriceController;
use App\Http\Controllers\RPO\GraphPriceController;
use App\Http\Controllers\RPO\SalesProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RPO\PalmPurchase;
use App\Http\Controllers\Technician\WorkOrderController;
use App\Http\Controllers\UserController;
use Laravel\Prompts\Table;

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
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/starter', [Controller::class, 'starterPage'])->name('starter');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

//-------- home ------//
Route::group(['middleware' => ['auth', 'role:developer|admin|GM|user']], function () {
    Route::get('/home', [Controller::class, 'home'])->name('home');
});

//-------- permissions ------//
Route::group(['middleware' => ['auth', 'role:developer|admin']], function () {
    Route::resource('permissions', PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

    Route::resource('roles', RoleController::class);
    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);

    Route::resource('users', UserController::class);
    Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);
});

//-------- RPO ------//
Route::group(['middleware' => ['auth', 'role:developer|admin|GM|admin-RPO']], function () {
    Route::get('/palm-purchase', [PalmPurchase::class, 'palmPurchase'])->name('palm-purchase');
    Route::get('/palm-plan', [PalmPurchase::class, 'palmPlan'])->name('palm-plan');
    Route::get('/sales-product', [SalesProductController::class, 'salesProduct'])->name('sales-product');
    Route::get('/report-palm-purchase', [PalmPurchase::class, 'reportPalmPurchase'])->name('report-palm-purchase');
    Route::get('/average-price', [AveragePriceController::class, 'averagePrice'])->name('average-price');
    Route::get('/graph-price', [GraphPriceController::class, 'graphPrice'])->name('graph-price');
});

//-------- HRE ------//
Route::group(['middleware' => ['auth', 'role:developer|admin|GM']], function () {
    Route::get('/employee', [Employee::class, 'employee'])->name('employee');
});

//-------- MAR ------//
Route::group(['middleware' => ['auth', 'role:developer|admin|GM|user-RPO|user-MAR']], function () {
    Route::get('/sales-plan', [SalesPlanController::class, 'salesPlan'])->name('sales-plan');
});

//-------- ACC ------//
Route::group(['middleware' => ['auth', 'role:developer|admin|GM|admin-ACC|user-ACC']], function () {
    Route::get('/purchase-price', [PurchasePriceController::class, 'purchasePrice'])->name('purchase-price');
});

//-------- CAR ------//
Route::group(['middleware' => ['auth', 'role:developer|admin|GM|user|staff']], function () {
    Route::get('/car-request', [CarController::class, 'carRequest'])->name('car-request');
    Route::get('/car-report', [CarController::class, 'carReport'])->name('car-report');
    Route::get('/car-view/{carReportId}', [CarController::class, 'carView'])->name('car-view');
    Route::get('/use-car', [UseCarController::class, 'useCar'])->name('use-car');
});

//-------- Dashboard ------//
Route::group(['middleware' => ['auth', 'role:developer|GM']], function () {
    Route::get('/graph-palm', [GraphController::class, 'graphPalmPuchase'])->name('graph-palm');
    Route::get('/table-palm', [TableTotalPalmController::class, 'tableTotalPalm'])->name('table-palm');
    Route::get('/graph-total-palm', [GraphTotalPalmController::class, 'graphTotalPalm'])->name('graph-total-palm');
});

//-------- Technician ------//
Route::group(['middleware' => ['auth', 'role:developer|admin|GM|user']], function () {
    Route::get('/work-order', [WorkOrderController::class, 'workOrder'])->name('work-order');
});






require __DIR__ . '/auth.php';
