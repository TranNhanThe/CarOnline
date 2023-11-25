<?php

use App\Http\Controllers\AdminController;
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
use App\Http\Controllers\PaymentController;
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
Route::group(['middleware' => 'admin'], function () {
      Route::prefix('admin')->name('admin.')->group(function () {
      Route::get('/', [AdminController::class, 'index'])->name('home');
      Route::get('/search', [AdminController::class, 'searchMaster'])->name('search');
      Route::get('/selectmodel', [AdminController::class, 'selectModel'])->name('selectModel');
      Route::get('/edit/{id}', [AdminController::class, 'getEdit'])->name('edit');
      Route::post('/update', [AdminController::class, 'postEdit'])->name('post-edit');
      Route::get('/delete/{id}', [AdminController::class, 'delete'])->name('delete');
      Route::get('/xe-thue/{id}', [AdminController::class, 'rentalshow'])->name('rentalshow');

      Route::get('/users/{id}', [AdminController::class, 'userinfo'])->name('userinfo');

      Route::get('/rentallist', [AdminController::class, 'rentallist'])->name('rentallist');

      Route::post('/status/{car}', [AdminController::class, 'toggleStatus'])->name('status.toggle');

      Route::post('/users/{id}', [AdminController::class, 'toggleUserStatus'])->name('userstatus.toggle');

      Route::get('/addmake', [AdminController::class, 'addMake'])->name('addMake');
      Route::post('/addmake', [AdminController::class, 'postAddMake'])->name('post-add');
      Route::post('/addmodel', [AdminController::class, 'postAddModel'])->name('addModel');
      // Route::middleware(['auth'])->get('/admin/increase-view-count/{id}', [AdminController::class, 'increaseViewCount'])->name('admin.increase-view-count');
    });
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'searchMaster'])->name('search');
Route::get('/selectmodel', [HomeController::class, 'selectModel'])->name('selectModel');
Route::post('/vnpay_payment', [PaymentController::class,'vnpay_payment']);

Route::prefix('rental')->name('rental.')->group(function () {
   Route::get('/', [RentalController::class, 'index'])->name('index');
   Route::middleware(['auth'])->get('/yoretaca', [RentalController::class, 'yoretaca'])->name('yoretaca');
   Route::middleware(['auth', 'checkuserstatus'])->get('/add', [RentalController::class, 'add'])->name('add');
   Route::middleware(['auth'])->get('/selectmodel', [HomeController::class, 'selectModel'])->name('selectModel');
   Route::middleware(['auth'])->get('/ad_readd/{id}', [RentalController::class, 'ad_readd'])->name('ad-readd');
   Route::middleware(['auth'])->post('/ad_readd/{id}', [RentalController::class, 'postAd_readd'])->name('post-ad_readd');
   Route::middleware(['auth'])->get('/ad_add/{id}', [RentalController::class, 'ad_add'])->name('ad-add');
   Route::middleware(['auth'])->post('/ad_add/{id}', [RentalController::class, 'postAd_add'])->name('post-ad_add');
   Route::middleware(['auth'])->post('/add', [RentalController::class, 'postAdd'])->name('post-add');
   Route::middleware(['auth'])->get('/credit', [RentalController::class, 'credit'])->name('credit');
   Route::middleware(['auth'])->post('/credit', [RentalController::class, 'postCredit'])->name('post-credit');
   Route::middleware(['auth'])->post('/vnpay_payment', [PaymentController::class,'vnpay_payment'])->name('vnpay_payment');
   Route::get('/xe-thue/{id}', [RentalController::class, 'show'])->name('show');
   Route::middleware(['auth'])->post('/xethue', [RentalController::class, 'postOne'])->name('post-one');
   Route::middleware(['auth'])->get('yorental', [RentalController::class, 'yorental'])->name('yorental');
   Route::middleware(['auth'])->get('youdealer', [RentalController::class, 'youDealer'])->name('yodealer');
   Route::middleware(['auth'])->get('/contract/{id}', [RentalController::class, 'contract'])->name('contract');

   Route::post('/agree/{id}', [RentalController::class, 'toggleAgree'])->name('agree.toggle');
   Route::post('/given/{id}', [RentalController::class, 'toggleGiven'])->name('given.toggle');
   Route::post('/take/{id}', [RentalController::class, 'toggleTake'])->name('take.toggle');
   Route::post('/back/{id}', [RentalController::class, 'toggleBack'])->name('back.toggle');
   Route::post('/finish/{id}', [RentalController::class, 'toggleFinish'])->name('finish.toggle');

   Route::post('/rating/{id}', [RentalController::class, 'rating'])->name('post-rating');
   Route::post('/usercheck/{id}', [RentalController::class, 'userCheck'])->name('post-usercheck');
   Route::post('/dealercheck/{id}', [RentalController::class, 'dealerCheck'])->name('post-dealercheck');

   Route::middleware(['auth'])->get('/dealer/{id}', [RentalController::class, 'dealer'])->name('dealer');
});
Route::group(['middleware' => 'auth'], function () {
Route::post('/favorite/{car}', [FavoriteController::class, 'toggleFavorite'])->name('favorite.toggle');
// Route::middleware(['auth'])->get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');


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

    Route::get('/info', [UsersController::class, 'userinfo'])->name('userinfo');

    Route::post('/info', [UsersController::class, 'postUserInfo'])->name('post-userinfo');

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
Route::group(['middleware' => 'guest'], function () {
Route::prefix('admin')->name('admin.')->group(function () { 
      
   // Định nghĩa các route cho trang đăng nhập và xử lý đăng nhập của admin ở đây
   Route::get('/loginad', [AdminController::class, 'adminlogin'])->name('loginad');
   Route::post('/loginad', [AdminController::class, 'adminloginPost'])->name('loginad');
 });
});