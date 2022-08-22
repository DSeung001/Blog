<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\RandomGeneratorController;

// 아까 우릴 환영해주던 라우팅 설정입니다.
Route::get('/', function () {
    return view('welcome');
});



// Laravel Excel

// Fast-excel
// Route::get('products/excel', [ProductController::class, 'excel'])->name('products.excel');


Route::get('products/export/', [ProductController::class, 'export'])->name('products.export');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('products/{product}',[ProductController::class, 'show'])->name("products.show");
Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name("products.edit");
Route::patch('products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('random',[RandomGeneratorController::class,'export'])->name('random.export');
