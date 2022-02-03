<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ZipController;


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


$prefix = "/v1/";

Route::post($prefix . 'calculateDistanceWithZipCodes', [ZipController::class, 'calculateDistanceWithZipCodes']);

Route::post($prefix . 'addZipCode', [ZipController::class, 'addZipCode']);
Route::post($prefix . 'updateZipCode', [ZipController::class, 'updateZipCode']);

Route::get($prefix . 'getZipCodes', [ZipController::class, 'getZipCodes']);
Route::get($prefix . 'getZipCode/{id}', [ZipController::class, 'getZipCode']);
Route::get($prefix . 'deleteZipCode/{id}', [ZipController::class, 'deleteZipCode']);
