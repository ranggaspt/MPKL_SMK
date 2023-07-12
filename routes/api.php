<?php

use App\Http\Controllers\API\AuthApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/login', [AuthApiController::class, 'login']);

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth:sanctum', 'user-access:student'])->group(function () {
    Route::apiResource('/journal', App\Http\Controllers\API\JournalApiController::class);
    Route::apiResource('/report', App\Http\Controllers\API\RepotsApiController::class);
    Route::get('/get-presensi',  [App\Http\Controllers\API\AttendancesApiController::class, 'getPresensis']);
    Route::get('/profile',  [App\Http\Controllers\API\ProfileApiController::class, 'index']);
    Route::post('save-presensi', [App\Http\Controllers\API\AttendancesApiController::class, 'savePresensi']);
    Route::post('/logout', [App\Http\Controllers\API\AuthApiController::class, 'logout']);
});





