<?php

use App\Http\Controllers\Api\Admin\ProdukController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\User\OrderProdutController;
use App\Http\Controllers\Api\User\ProdukController as UserProdukController;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::prefix('admin')->group(function () {
        Route::resource('produk', ProdukController::class);
    });

    Route::post('beli-produk', [OrderProdutController::class, 'store']);

    Route::post('logout', [AuthController::class, 'logout']);
});

Route::get('produk', [UserProdukController::class, 'index']);
Route::get('produk/{id}', [UserProdukController::class, 'show']);
