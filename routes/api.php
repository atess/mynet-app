<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\PersonController;
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

Route::resource('address', AddressController::class)
    ->only(['index','show','update','store','destroy']);

Route::resource('person', PersonController::class)
    ->only(['index','show','update','store','destroy']);
