<?php

use Illuminate\Http\Request;
use illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\barangController;
use App\Http\Controllers\API\departemenController;
use App\Http\Controllers\API\karyawanController;
use App\Http\Controllers\API\permintaanController;
use App\Http\Controllers\API\userController;

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

Route::get('ambildatabarang',[barangController::class, 'index']);
Route::get('ambildatakaryawan',[karyawanController::class, 'index']);
Route::get('ambildatadepartemen',[departemenController::class, 'index']);
Route::get('ambildatapermintaan',[permintaanController::class, 'index']);

Route::apiResources([
    'user' => userController::class,
    'karyawan' => karyawanController::class,
    'barang' => barangController::class,
    'permintaan' => permintaanController::class,
]);
