<?php

use App\Packages\Exams\Controller\ThemeController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/healthcheck', function () {
    return json_encode(['status' => true]);
});


Route::get('/temas', [ThemeController::class, 'index']);
Route::post('/temas', [ThemeController::class, 'store']);
Route::put('/temas/{id}', [ThemeController::class, 'update']);
Route::get('/temas/{id}', [ThemeController::class, 'show']);
Route::delete('/temas/{id}', [ThemeController::class, 'destroy']);