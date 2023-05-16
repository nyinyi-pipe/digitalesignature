<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Mail\MailController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//home
Route::get('/', [HomeController::class,'index'])->name('home');
//auth
Route::middleware('auth')->group(function () {
    //dashboard
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    //document
    Route::get('/documents', [DocumentController::class,'index'])->name('document.index');
    Route::get('/documents/add-document', [DocumentController::class,'create'])->name('document.add-document');
    Route::post('/documents/add-document', [DocumentController::class,'store'])->name('document.add-document');
    Route::get('/documents/{document}/add-recipients', [DocumentController::class,'recipients'])->name('document.add-recipients');
    Route::put('/documents/{document}/add-recipients', [DocumentController::class,'storeRecipients'])->name('document.store-recipients');
    Route::get('/documents/edit/{document}', [DocumentController::class,'editDocument'])->name('document.edit.document');
    Route::post('/documents/edit/{document}', [MailController::class,'sendMail'])->name('document.send.mail');
    Route::delete('/documents/edit/{document}', [DocumentController::class,'deleteDoc'])->name('documents.delete.document');
    Route::put('/documents/edit/{document}', [DocumentController::class,'newDocumentName'])->name('document.new.document-name');
    Route::get('/documents/send', [DocumentController::class,'send'])->name('document.send');
    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::get('test', function () {
    return Inertia::render("Test");
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
