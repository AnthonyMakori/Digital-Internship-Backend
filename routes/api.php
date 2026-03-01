<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::prefix('company/{companyId}')->group(function () {
    Route::get('/vacancies', [VacancyController::class, 'index']);
});

Route::post('/vacancies', [VacancyController::class, 'store']);
Route::put('/vacancies/{id}', [VacancyController::class, 'update']);
Route::delete('/vacancies/{id}', [VacancyController::class, 'destroy']);
Route::patch('/vacancies/{id}/toggle', [VacancyController::class, 'toggleStatus']);
});
