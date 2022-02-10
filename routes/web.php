<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['auth']], function() {

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/category', function () {
    return view('category');
})->name('category');
Route::post('/add-category', [CategoriesController::class,'store'])->name('add-category');;
Route::get('/view-category', [CategoriesController::class,'view'])->name('view-category');;
Route::get('/edit-category/{pid}', [CategoriesController::class,'edit'])->name('edit-category');
Route::post('/update-category',[CategoriesController::class, 'update'])->name('update-category');
Route::post('/delete-category', [CategoriesController::class,'delete'])->name('delete-category');
Route::get('/cat-export-to-excel', [CategoriesController::class,'excel_export'])->name('cat-export-to-excel');;
Route::get('/cat-export-to-pdf', [CategoriesController::class,'pdf_export'])->name('cat-export-to-pdf');;


Route::get('/product',[ProductController::class,'index'])->name('product');

Route::post('/add-product', [ProductController::class,'store'])->name('add-product');
Route::get('/view-product', [ProductController::class,'view'])->name('view-product');;
Route::get('/edit-product/{pid}', [ProductController::class,'edit'])->name('edit-product');
Route::post('/update-product',[ProductController::class, 'update'])->name('update-product');
Route::post('/delete-product', [ProductController::class,'delete'])->name('delete-product');
Route::get('/product-export-to-excel', [ProductController::class,'product_excel_export'])->name('product-export-to-excel');;
Route::get('/product-export-to-pdf', [ProductController::class,'product_pdf_export'])->name('product-export-to-pdf');

});

require __DIR__.'/auth.php';

Route::get('redirect/{driver}', [UserController::class,'redirectToProvider']);
Route::get('auth/google/callback', [UserController::class,'handleGoogleCallback']);
