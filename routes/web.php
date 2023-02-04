<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class,'index'])->name('dashboardIndex');
    //Route::resource('dashboard', DashboardController::class);

    Route::post('/update_display', [CategoryController::class,'update_display']);
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

    Route::get('report', [ReportController::class, 'index']);
    Route::post('report/getCustomerReport', [ReportController::class, 'getCustomerReport']);
    Route::post('report/getProductReport', [ReportController::class, 'getProductReport']);
    Route::post('report/getRegisterReport', [ReportController::class, 'getRegisterReport']);
    Route::post('report/getStockReport', [ReportController::class, 'getStockReport']);
    Route::get('report/getStockReport', [ReportController::class, 'getStockReport']);

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
});

Route::inertia('/login', 'Users/Index')->name('login');
Route::post('login', [LoginController::class, 'store'])->name('login.post');
