<?php

use App\Packages\Exams\Controller\QuestionController;
use App\Packages\Student\Controller\StudentController;
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

Route::get('/student', [StudentController::class, 'index']);
Route::post('/student', [StudentController::class, 'store']);
Route::put('/student', [StudentController::class, 'update']);
Route::get('/student/{id}', [StudentController::class, 'show']);
Route::delete('/student/{id}', [StudentController::class, 'destroy']);

Route::get('/theme', [QuestionController::class, 'index']);
Route::post('/theme', [QuestionController::class, 'store']);
Route::put('/theme/{id}', [QuestionController::class, 'update']);
Route::get('/theme/{id}', [QuestionController::class, 'show']);
Route::delete('/theme/{id}', [QuestionController::class, 'destroy']);

Route::get('/question', [QuestionController::class, 'index']);
Route::post('/question', [QuestionController::class, 'store']);
Route::put('/question/{id}', [QuestionController::class, 'update']);
Route::get('/question/{id}', [QuestionController::class, 'show']);
Route::delete('/question/{id}', [QuestionController::class, 'destroy']);