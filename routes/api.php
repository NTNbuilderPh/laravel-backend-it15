<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WeatherController;

Route::post('/login', [AuthController::class, 'login']);

// Weather endpoints are public (Open-Meteo is free / no credentials)
Route::prefix('weather')->group(function () {
    Route::get('/forecast', [WeatherController::class, 'forecast']);
    Route::get('/geocode',  [WeatherController::class, 'geocode']);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me',     [AuthController::class, 'me']);
    Route::post('/logout',[AuthController::class, 'logout']);

    Route::get('/students',          [StudentController::class, 'index']);
    Route::get('/students/{student}',[StudentController::class, 'show']);
    Route::get('/courses',           [CourseController::class, 'index']);

    Route::prefix('dashboard')->group(function () {
        Route::get('/stats',               [DashboardController::class, 'stats']);
        Route::get('/enrollment-trends',   [DashboardController::class, 'enrollmentTrends']);
        Route::get('/course-distribution', [DashboardController::class, 'courseDistribution']);
        Route::get('/attendance-patterns', [DashboardController::class, 'attendancePatterns']);
        Route::get('/demographics',        [DashboardController::class, 'demographics']);
    });
});
