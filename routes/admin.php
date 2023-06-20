<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\InputController;
use App\Http\Controllers\Admin\SendController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SignatureController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('auth', 'admin', 'approv')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('admin.dashboard');

    Route::get('/approvement', [UserController::class,'approvement'])->name('admin.user.approvement');
    Route::put('/approvement', [UserController::class,'status'])->name('admin.user.status');
    Route::delete('/approvement/user', [UserController::class,'destory'])->name('admin.user.destory');

    Route::get('/inputs', [InputController::class,'index'])->name('admin.input.index');

    Route::get('/send-documents', [SendController::class,'index'])->name('admin.send-document.index');

    Route::get('/documents', [DocumentController::class,'index'])->name('admin.document.index');

});
