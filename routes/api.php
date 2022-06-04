<?php

use App\Http\Controllers\Api\InnerController;
use App\Http\Controllers\Api\MasterController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\PlasticController;
use App\Http\Controllers\Api\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('product/plastic/{id}', [PlasticController::class, 'getPlastic'])->name('api.get_plastic.by.product_id');
Route::get('product/inner/{id}', [InnerController::class, 'getInner'])->name('api.get_inner.by.product_id');
Route::get('product/master/{id}', [MasterController::class, 'getMaster'])->name('api.get_master.by.product_id');


Route::get('material/{id}', [MaterialController::class, 'show'])->name('api.show.material');
Route::get('product/{id}', [ProductController::class, 'show'])->name('api.show.product');
