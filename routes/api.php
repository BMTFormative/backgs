<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\PaycustomerController;
use App\Http\Controllers\GlobalsellbuyController;
use App\Http\Controllers\GlobalpaymentController;
use App\Http\Controllers\TaxeController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});


Route::apiResource('products', ProductController::class);
Route::apiResource('suppliers', SupplierController::class);
Route::apiResource('customers', CustomerController::class);
Route::apiResource('sales', SaleController::class);
Route::apiResource('stocks', StockController::class);
Route::apiResource('paycustomers', PaycustomerController::class);
Route::apiResource('globalsellbuys', GlobalsellbuyController::class);
Route::apiResource('globalpayments', GlobalpaymentController::class);
Route::apiResource('taxes', TaxeController::class);


Route::get('sales/by-number/{saleNumber}', [SaleController::class, 'fetchBySaleNumber']);
// Additional route for updating the status of a tax
Route::patch('taxes/{tax}/Status', [TaxeController::class, 'updateStatus']);
