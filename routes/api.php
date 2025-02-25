<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\JobApplicationController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    // JobPosting routes
    Route::get('/job-listings', [JobPostingController::class, 'index']);
    Route::post('/job-listings', [JobPostingController::class, 'store']);
    Route::get('/job-listings/{jobPosting}', [JobPostingController::class, 'show']);
    Route::put('/job-listings/{jobPosting}', [JobPostingController::class, 'update']);
    Route::delete('/job-listings/{jobPosting}', [JobPostingController::class, 'destroy']);

    // JobApplication routes
    Route::get('/applications', [JobApplicationController::class, 'index']);
    Route::post('/apply', [JobApplicationController::class, 'store']);
    Route::get('/applications/{jobApplication}', [JobApplicationController::class, 'show']);
    Route::put('/applications/{jobApplication}', [JobApplicationController::class, 'update']);
    Route::delete('/applications/{jobApplication}', [JobApplicationController::class, 'destroy']);

    // Logout route
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
