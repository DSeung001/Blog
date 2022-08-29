<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ImageController::class, 'index'])->name('image.index');
Route::get('/create', [ImageController::class, 'create'])->name('image.create');
Route::post('/store', [ImageController::class, 'store'])->name('image.store');
Route::delete('{image}', [ImageController::class, 'destroy'])->name('image.destroy');
Route::post('/destroy', [ImageController::class, 'ajaxDestroy'])->name('image.ajaxDestroy');

