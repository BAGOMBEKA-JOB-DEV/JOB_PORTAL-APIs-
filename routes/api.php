<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


                        //job apis
//for storing data in the jobs table
Route::post('/job', [JobController::class, 'store']);
//for fetching data in the jobs table
Route::get('/jobs', [JobController::class, 'index']);
//for updating the data in the jobs table
Route::put('/job/{id}', [JobController::class, 'update']);
//for deleting the data in the jobs table
Route::delete('/job/{id}', [JobController::class, 'destroy']);



