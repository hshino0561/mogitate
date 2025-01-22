<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/search', [ProductController::class, 'search']);

// 商品登録画面表示用
Route::get('/products/register', [ProductController::class, 'reg_show'])->name('products.register');

// 商品登録処理用
Route::post('/products/register', [ProductController::class, 'store'])->name('products.store');

// 商品詳細画面
Route::get('/products/{productId}', [ProductController::class, 'detail_show']);

// 更新処理のルートを設定
Route::put('/products/{productId}/update', [ProductController::class, 'update'])->name('products.update');

// 削除処理のルートを設定
Route::delete('/products/{productId}/delete', [ProductController::class, 'destroy'])->name('products.destroy');
