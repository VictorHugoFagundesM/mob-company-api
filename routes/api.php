<?php

// rotas de perfil

use App\Http\Controllers\PhoneController;
use Illuminate\Support\Facades\Route;

Route::prefix('phones')->name('phone.')->group(function () {
    Route::get('/', [PhoneController::class, 'getData'])->name('get');
    Route::post('/', [PhoneController::class, 'store'])->name('store');
    Route::put('/', [PhoneController::class, 'update'])->name('update');
    Route::delete('/{id}/delete', [PhoneController::class, 'destroy'])->name('destroy');
});
