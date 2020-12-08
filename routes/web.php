<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index']);
Route::post('/checkClientEnter', [\App\Http\Controllers\HomeController::class, 'checkClientEnter']);

Route::get('/graphic', [\App\Http\Controllers\GraphicsController::class, 'index']);
Route::post('/create', [\App\Http\Controllers\GraphicsController::class, 'create']);
Route::post('/edit', [\App\Http\Controllers\GraphicsController::class, 'edit']);
Route::post('/deleteGraphic', [\App\Http\Controllers\GraphicsController::class, 'destroy']);

Route::get('/client', [\App\Http\Controllers\ClientsController::class, 'index']);
Route::post('/deleteClient', [\App\Http\Controllers\ClientsController::class, 'destroy']);
Route::post('/client', [\App\Http\Controllers\ClientsController::class, 'uploadProfileImage'])->name('profileAvatar');
Route::post('/session', [\App\Http\Controllers\ClientsController::class, 'sendClientIdToSession']);
Route::post('/client/edit', [\App\Http\Controllers\ClientsController::class, 'edit']);
Route::post('/client/create', [\App\Http\Controllers\ClientsController::class, 'create']);

Route::get('/clients-logs',[\App\Http\Controllers\ClientsLogController::class, 'index']);
Route::post('/addClientActivityToLogs', [\App\Http\Controllers\ClientsLogController::class, 'addClientActivityToLogs']);
Route::post('/deleteLog', [\App\Http\Controllers\ClientsLogController::class, 'destroy']);

