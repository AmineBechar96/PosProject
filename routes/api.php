<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();*/
    /*index problem */
    Route::resource('dashboard', DashboardController::class);
    Route::resource('login', AuthController::class);
    Route::resource('categories', [CategoryController::class,'store','update','destroy']);
    Route::resource('categorieexpences', CategoryExpenceController::class);
    /* pivot table */
    Route::resource('combos', ComboController::class);
    Route::resource('customers', CustomerController::class);
    /* expence attachement unlink */
    Route::resource('expences', ExpenceController::class);
    /* hold show fronend**/
    Route::resource('holds', HoldController::class);
    /* kitechen show fronend**/
    Route::resource('kitchens', KitchenController::class);
    /* last **/
    Route::resource('pos', PosController::class);
    /* last **/
    Route::resource('purchases', PurchaseController::class);
    Route::resource('registers', RegisterController::class);
    //Route::resource('Report', ReportController::class);
    Route::resource('sale', SaleController::class);
    //done
    Route::resource('settings', SettingController::class);
    Route::resource('stores', StoreController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('tables', TablesController::class);
    Route::resource('waiters', WaiterController::class);
    Route::resource('warehouses', WarehouseController::class);
    Route::resource('zones', ZoneController::class);
/* }); */
