<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    authController,
    disciplinaController,
    FuncaoController,
    professorDisciplinaController,
    TurmaController,
    MaterialAulasController,
    TurmaMateriaController
};
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
Route::post('login', [authController::class, 'login']);
Route::post('register', [authController::class, 'register']);



Route::middleware(['auth:api'])->group(function () {
    
    Route::get('logout', [authController::class, 'logout']);
    Route::get('me', [authController::class, 'me']);
    Route::post('refresh', [authController::class, 'refresh']);

    Route::apiresource('disciplina', disciplinaController::class);
    Route::apiresource('materia', professorDisciplinaController::class);
    Route::apiresource('turma', TurmaController::class);
    Route::apiResource('material-aulas', MaterialAulasController::class);
});

Route::apiResource('turma-materia', TurmaMateriaController::class);
Route::apiResource('funcao', FuncaoController::class);