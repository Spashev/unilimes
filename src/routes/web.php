<?php

use App\Http\Controllers\UploadFileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [UploadFileController::class, 'index'])->name('main');
Route::post('upload', [UploadFileController::class, 'upload'])->name('upload');
