<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TableController;
use App\Models\PayementIncome;
use App\Models\PayementOutcome;
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
Route::resource('categories', CategoryController::class);
Route::resource('categorieexpences', CategoryExpenceController::class);
Route::resource('combos', ComboController::class);

Route::post('customers/customerName', [CustomerController::class, 'customerName']);
Route::post('customers/changeCustomers', [CustomerController::class, 'changeCustomers']);
Route::resource('customers', CustomerController::class);

Route::resource('expences', ExpenceController::class);
Route::post('holds/removeHold', [HoldController::class, 'removeHold']);
Route::resource('holds', HoldController::class);
Route::resource('kitchens', KitchenController::class);
Route::resource('payementIncome', PayementIncomeController::class);
Route::resource('payementOutcome', PayementOutcomeController::class);

Route::post('pos/showticketKit', [PosController::class, 'showticketKit']);
Route::post('pos/showTicket', [PosController::class, 'showTicket']);
Route::post('pos/subTot', [PosController::class, 'subTot']);
Route::post('pos/totPosales', [PosController::class, 'totPosales']);
Route::post('pos/addPosaleOptions', [PosController::class, 'addPosaleOptions']);
Route::get('pos/resetPos/{id}', [PosController::class, 'resetPos']);
Route::resource('pos', PosController::class);

Route::get('products/updateStock/{id}', [ProductController::class, 'updateStock']);
Route::post('products/createStock', [ProductController::class, 'createStock']);
Route::get('products/makePrdInvis/{id}/{store_id}', [ProductController::class, 'makePrdInvis']);
Route::resource('products', ProductController::class);


Route::resource('purchases', PurchaseController::class);
Route::resource('registers', RegisterController::class);
//done
Route::get('report', [ReportController::class, 'index']);
Route::post('report/getCustomerReport', [ReportController::class, 'getCustomerReport']);
Route::post('report/getProductReport', [ReportController::class, 'getProductReport']);
Route::post('report/getRegisterReport', [ReportController::class, 'getRegisterReport']);
Route::post('report/getStockReport', [ReportController::class, 'getStockReport']);
Route::get('report/getStockReport', [ReportController::class, 'getStockReport']);


//done
Route::resource('sale', SaleController::class);
Route::resource('settings', SettingController::class);
Route::resource('stores', StoreController::class);
Route::resource('suppliers', SupplierController::class);

Route::get('tables/switchTable/{register_id}', [TableController::class, 'switchTable']);
Route::get('tables/selectTable/{register_id}/{id}', [TableController::class, 'selectTable']);
Route::post('tables/exchangeTables', [TableController::class, 'exchangeTables']);
Route::resource('tables', TableController::class);

Route::post('waiters/changeWaiters', [WaiterController::class, 'changeWaiters']);
Route::post('waiters/waiterName', [WaiterController::class, 'waiterName']);
Route::get('waiters/storeWaiterCash/{id}', [WaiterController::class, 'storeWaiterCash']);
Route::resource('waiters', WaiterController::class);
Route::resource('warehouses', WarehouseController::class);
Route::resource('zones', ZoneController::class);
/* }); */
