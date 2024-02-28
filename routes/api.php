<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FamilyClientController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SafeTypeController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::delete('logout', [AuthController::class, 'logOut'])->middleware('auth:sanctum');
Route::get('/show-users', [AuthController::class, 'ShowUsers']);
// Auth

Route::resource('clients', ClientController::class);
Route::resource('safetypes', SafeTypeController::class);
Route::resource('providers', ProviderController::class);
Route::resource('familys', FamilyClientController::class);
Route::resource('budgets', BudgetController::class);
