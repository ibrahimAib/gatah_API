<?php

use App\Http\Controllers\Api\V1\BalanceController;
use App\Http\Controllers\Api\V1\BillController;
use App\Http\Controllers\Api\V1\BillRequestController;
use App\Http\Controllers\Api\V1\GatahController;
use App\Http\Controllers\Api\V1\GatahRequestController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/current', [GatahController::class, 'show']);
    Route::get('/', [GatahController::class, 'index']);
    Route::post('/submit-gatah', [GatahController::class, 'store']);
    Route::post('/update-gatah/{gatah}', [GatahController::class, 'update']);

    Route::get('/bills', [BillController::class, 'index']);
    Route::post('/add-bill', [BillController::class, 'store']);

    Route::get('/balance', [BalanceController::class, 'index']);
});


Route::group(['prefix' => 'v1/admin', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/gatah-request', [GatahRequestController::class, 'index']);
    Route::post('/approve-gatah/{gatah}', [GatahRequestController::class, 'approve_gatah']);
    
    
    Route::get('/bill-request', [BillRequestController::class, 'index']);
    Route::post('/pay-bill/{bill}', [BillRequestController::class, 'bill_paid']);
});



Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/auth_test', [AuthController::class, 'auth_test']);
