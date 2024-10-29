<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/medicationplan', function () {
    return view('UserArea.medicationplan');
})->middleware('auth');

Route::get('/', function () {
    return view('UserArea.overview');
})->middleware('auth');


Auth::routes([
        'email' => false,
        'request' => false,
        'update' => false,
        'reset' => false
]);;


Route::post('/api/medicament', [\App\Http\Controllers\MedicamentController::class, 'store'])->middleware('auth');
Route::delete('/api/medicament/{id}', [\App\Http\Controllers\MedicamentController::class, 'destroy'])->middleware('auth');
Route::patch('/api/medicament/{id}', [\App\Http\Controllers\MedicamentController::class, 'update'])->middleware('auth');
Route::get('/api/medicationplan', [\App\Http\Controllers\MedicamentController::class, 'index'])->middleware('auth');
