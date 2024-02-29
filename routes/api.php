<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FamilyClientController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SafeTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth

Route::post('login', [AuthController::class, 'login']);

Route::resource('users', UserController::class);

// Auth



Route::middleware('auth:sanctum')->group(function () {

    Route::resource('clients', ClientController::class);
    Route::resource('safetypes', SafeTypeController::class);
    Route::resource('providers', ProviderController::class);
    Route::resource('familys', FamilyClientController::class);
    Route::resource('budgets', BudgetController::class);

    Route::delete('logout', [AuthController::class, 'logOut']);
    Route::get('/show-users', [AuthController::class, 'ShowUsers']);
    Route::post('register', [AuthController::class, 'register']);



});
