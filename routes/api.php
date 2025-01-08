<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SiswaController;

Route::prefix('siswa')->group(function () {
    Route::get('/', [SiswaController::class, 'index']);
    Route::post('/', [SiswaController::class, 'store']);
    Route::get('/{id}', [SiswaController::class, 'show']);
    Route::put('/{id}', [SiswaController::class, 'update']);
    Route::delete('/{id}', [SiswaController::class, 'destroy']);
});
