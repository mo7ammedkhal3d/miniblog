<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\AuthorController;
use App\Http\Controllers\PostController;;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminAuthorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[PostController::class,'index'])->name('home');
Route::get('/single/post/{id}',[PostController::class,'getSinglePost'])->name('posts.singlePost');
Route::get('/about',function(){
    return view('posts.about');
})->name('about');
Route::get('/contact',function(){
    return view('posts.contact');
})->name('contact');
Route::post('/contact',[PostController::class,'contact']);
Route::get('/admin', function(){
    return view('admin.postdashboard');
})->name('admin');
Route::resource('posts',AdminPostController::class);
Route::resource('authors',AdminAuthorController::class);