<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentResultController;
use App\Http\Controllers\Mail\MailController;
use App\Http\Controllers\SendController;
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
    Route::post('/documents/add-document', [DocumentController::class,'store'])->name('documents.add-document');
    Route::delete('/documents/{document}', [DocumentController::class,'destroy'])->name('documents.delete-document');

    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile', [ProfileController::class, 'avatar'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
Route::middleware(['auth','editdoc'])->group(function () {
    Route::get('/documents/{document}/add-recipients', [DocumentController::class,'recipients'])->name('document.add-recipients');
    Route::put('/documents/{document}/add-recipients', [DocumentController::class,'storeRecipients'])->name('document.store-recipients');
    Route::put('/documents/{document}/add-recipient', [DocumentController::class,'addRecipients'])->name('document.add.recipients');
    Route::get('/documents/edit/{document}', [DocumentController::class,'editDocument'])->name('document.edit.document');
    Route::post('/documents/edit/{document}', [MailController::class,'sendMail'])->name('document.send.mail');
    Route::delete('/documents/edit/{document}', [DocumentController::class,'deleteDoc'])->name('documents.delete.document');
    Route::post('/documents/document/result', [DocumentResultController::class,'store'])->name('documents.store.document.result');
    Route::put('/documents/edit/{document}', [DocumentController::class,'newDocumentName'])->name('document.new.document-name');
    Route::get('/documents/send', [DocumentController::class,'send'])->name('document.send');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/send-documents', [SendController::class,'index'])->name('send-document.index');
    Route::get('/send-documents/{document}', [SendController::class,'show'])->name('send-document.show');
});


Route::get('/documents/v/{document}', [DocumentController::class,'view'])->name('document.view.document');
Route::get('/documents/c/v/{document}', [DocumentController::class,'ccview'])->name('document.cc.view.document');
Route::get('/document/v/{document}', [DocumentController::class,'viewUpdate'])->name('document.view.update.document');
Route::put('/document/v/{document}', [DocumentController::class,'finishUpdate'])->name('document.finish.update.document');

Route::get('/u/{document}/{recipient}', [DocumentResultController::class,'edit'])->name('recipient.edit.document');
Route::put('/u/{document}/{recipient}', [DocumentResultController::class,'update'])->name('recipient.update.document');
Route::put('/u/{document}', [DocumentResultController::class,'updateStatus'])->name('recipient.update.status.document');



require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
