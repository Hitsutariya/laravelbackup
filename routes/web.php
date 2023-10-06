<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('products', ProductController::class);
Route::get('products/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/', [ProductController::class, 'index']);
Route::resource('category', CategoryController::class); 
Route::get('category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::get('/', [CategoryController::class, 'index']);
// Route::resource('products', ProductController::class);
// Route::get('get-category-options', [ProductController::class, 'getCategoryOptions']);
// Route::get('products-datatable', [ProductController::class, 'datatable'])->name('products.datatable');
