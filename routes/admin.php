<?php
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SignatureController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'auth'], function () {
    Route::get('/approvement', [UserController::class,'approvement'])->name('user.approvement');
    Route::get('/signature', [SignatureController::class,'index'])->name('signature.index');
});
