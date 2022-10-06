<?php

use App\Packages\Exams\Controller\AlternativeController;
use App\Packages\Exams\Controller\ExamController;
use App\Packages\Exams\Controller\QuestionController;
use App\Packages\Exams\Controller\ThemeController;
use App\Packages\Student\Controller\StudentController;
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
Route::put('/student/{id}', [StudentController::class, 'update']);
Route::get('/student/{id}', [StudentController::class, 'show']);
Route::delete('/student/{id}', [StudentController::class, 'destroy']);

Route::get('/theme', [ThemeController::class, 'index']);
Route::post('/theme', [ThemeController::class, 'store']);
Route::put('/theme/{id}', [ThemeController::class, 'update']);
Route::get('/theme/{id}', [ThemeController::class, 'show']);
Route::delete('/theme/{id}', [ThemeController::class, 'destroy']);

Route::get('/question', [QuestionController::class, 'index']);
Route::post('/question', [QuestionController::class, 'store']);
Route::put('/question/{id}', [QuestionController::class, 'update']);
Route::get('/question/{id}', [QuestionController::class, 'show']);
Route::delete('/question/{id}', [QuestionController::class, 'destroy']);

Route::get('/alternative', [AlternativeController::class, 'index']);
Route::post('/alternative', [AlternativeController::class, 'store']);
Route::put('/alternative/{id}', [AlternativeController::class, 'update']);
Route::get('/alternative/{id}', [AlternativeController::class, 'show']);
Route::delete('/alternative/{id}', [AlternativeController::class, 'destroy']);

Route::get('/exam', [ExamController::class, 'index']);
Route::post('/exam', [ExamController::class, 'store']);
Route::put('/exam/{id}', [ExamController::class, 'update']);
Route::get('/exam/{id}', [ExamController::class, 'show']);
Route::delete('/exam/{id}', [ExamController::class, 'destroy']);