<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\VacancyController;

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

Route::prefix('admin')->group(function() {
    // Departments
    Route::get('departments', [AdminSettingsController::class, 'getDepartments']);
    Route::post('departments', [AdminSettingsController::class, 'addDepartment']);
    Route::delete('departments/{id}', [AdminSettingsController::class, 'removeDepartment']);

    // Categories
    Route::get('categories', [AdminSettingsController::class, 'getCategories']);
    Route::post('categories', [AdminSettingsController::class, 'addCategory']);
    Route::delete('categories/{id}', [AdminSettingsController::class, 'removeCategory']);

    // Universities & Faculties
    Route::get('universities', [AdminSettingsController::class, 'getUniversities']);
    Route::post('universities', [AdminSettingsController::class, 'addUniversity']);
    Route::delete('universities/{id}', [AdminSettingsController::class, 'removeUniversity']);
    Route::post('faculties', [AdminSettingsController::class, 'addFaculty']);
    Route::delete('faculties/{id}', [AdminSettingsController::class, 'removeFaculty']);

    // Evaluation Criteria
    Route::get('evaluation-criteria', [AdminSettingsController::class, 'getEvalCriteria']);
    Route::post('evaluation-criteria', [AdminSettingsController::class, 'addEvalCriterion']);
    Route::put('evaluation-criteria/{id}', [AdminSettingsController::class, 'updateEvalCriterion']);
    Route::delete('evaluation-criteria/{id}', [AdminSettingsController::class, 'removeEvalCriterion']);

    // System Config
    Route::get('system-config', [AdminSettingsController::class, 'getSystemConfig']);
    Route::put('system-config', [AdminSettingsController::class, 'updateSystemConfig']);
});
});
