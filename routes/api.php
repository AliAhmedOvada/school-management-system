<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\FlightController;

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
Route::post('/register', [AuthController::class, 'createUser']);
Route::post('/login', [AuthController::class, 'loginUser']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
});

Route::post('/getValue', [TestController::class, 'getValue'])->name('getValue');

Route::get('/flights', [FlightController::class, 'index']);
Route::post('/flights', [FlightController::class, 'store']);
Route::get('/flights/{id}', [FlightController::class, 'show']);
Route::put('/flights/{id}', [FlightController::class, 'update']);
Route::delete('/flights/{id}', [FlightController::class, 'destroy']);
Route::post('/addTasksToFlight/{id}', [FlightController::class, 'addTasksToFlight']);


Route::apiResource('tasks', TaskController::class);



