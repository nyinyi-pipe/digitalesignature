<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

//home
Route::get('/', [HomeController::class,'index'])->name('home');
//auth
Route::middleware('auth')->group(function () {
    //dashboard
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    //document
    Route::get('/documents', [DocumentController::class,'index'])->name('document.index');
    Route::get('/documents/bulk-import', [DocumentController::class,'bulkImport'])->name('document.bulk-import');
    Route::get('/documents/send', [DocumentController::class,'send'])->name('document.send');
    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
