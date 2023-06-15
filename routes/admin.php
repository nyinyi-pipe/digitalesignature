<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SignatureController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth', 'admin')->group(function () {
    Route::get('/approvement', [UserController::class,'approvement'])->name('user.approvement');
    Route::put('/approvement', [UserController::class,'status'])->name('user.status');
    Route::delete('/approvement/user', [UserController::class,'destory'])->name('user.destory');
    Route::get('/signature', [SignatureController::class,'index'])->name('signature.index');
});
