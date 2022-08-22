<?php

use App\Http\Controllers\ImageUploadController;
use Illuminate\Support\Facades\Route;


Route::get('/image/upload', [ImageUploadController::class, 'create']);
Route::post('/image/upload/store', [ImageUploadController::class, 'store']);
Route::post('/image/destroy', [ImageUploadController::class, 'destroy']);

Route::get('/', function () {
    return view('welcome');
});

