<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\CatController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\SearchController;


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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('rental')->name('rental.')->group(function () {
   Route::get('/', [RentalController::class, 'index'])->name('index');
   Route::middleware(['auth'])->get('/add', [RentalController::class, 'add'])->name('add');
   Route::middleware(['auth'])->post('/add', [RentalController::class, 'postAdd'])->name('post-add');
   // Route::get('/detail/{id}', [RentalController::class, 'getCarDetail'])->name('detail');
   Route::get('/xe-thue/{id}', [RentalController::class, 'show'])->name('show');
});
Route::group(['middleware' => 'auth'], function () {
Route::post('/favorite/{car}', [FavoriteController::class, 'toggleFavorite'])->name('favorite.toggle');
// Route::middleware(['auth'])->get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');

Route::get('/search', [HomeController::class, 'searchMaster'])->name('search');
Route::get('/favorite', [HomeController::class, 'allFavor'])->name('favorite');
Route::get('/san-pham', [HomeController::class, 'products'])->name('product');


Route::get('/them-san-pham', [HomeController::class, 'getAdd']);
Route::post('/them-san-pham', [HomeController::class, 'postAdd'])->name('post-add');


Route::put('/them-san-pham', [HomeController::class, 'putAdd']);



Route::get('lay-thong-tin', [HomeController::class, 'getArr']);

Route::get('demo-response-2', function (Response $request) {
    return $request->cookie('unicode');
});

Route::get('demo-response', function () {
    return '<h2>Welcome to Unicode</h2>';
 });

 Route::get('demo-response', function(){
    return view('clients.demo-text');
 })->name('demo-response');

 Route::get('download-image', [HomeController::class, 'downloadImage'])->name('download-image');

 Route::get('download-doc', [HomeController::class, 'downloadDoc'])->name('download-doc');


 //Người dùng
 Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UsersController::class, 'index'])->name('index');

    Route::get('/add', [UsersController::class, 'add'])->name('add');

    Route::post('/add', [UsersController::class, 'postAdd'])->name('post-add');

    Route::get('/edit/{id}', [UsersController::class, 'getEdit'])->name('edit');

    Route::post('/update', [UsersController::class, 'postEdit'])->name('post-edit');

    Route::get('/delete/{id}', [UsersController::class, 'delete'])->name('delete');

 });



 Route::prefix('posts')->name('posts.')->group(function () {
   Route::get('/', [PostController::class, 'index'])->name('index');

   Route::get('/add', [PostController::class, 'add'])->name('add');

   
 });

 Route::get('/create', [CatController::class, 'create']);
Route::post('/create', [CatController::class, 'store']);

Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

});

Route::group(['middleware' => 'guest'], function () {
   Route::get('/register', [AuthController::class, 'register'])->name('register');
   Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
   Route::get('/login', [AuthController::class, 'login'])->name('login');
   Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});