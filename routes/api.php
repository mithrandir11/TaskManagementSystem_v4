<?php

use App\Http\Controllers\API\TaskController;
use Illuminate\Support\Facades\Route;


// Route::apiResource('tasks', TaskController::class);
Route::get('tasks', [TaskController::class, 'index']);
Route::post('tasks', [TaskController::class, 'store']);
Route::put('tasks/{task_id}', [TaskController::class, 'update']);
Route::delete('tasks/{task_id}', [TaskController::class, 'destroy']);

Route::get('tasks/user/{user_id}', [TaskController::class, 'userTasks']);
Route::put('tasks/update-status/{task_id}', [TaskController::class, 'updateStatus']);

