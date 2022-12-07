<?php

use App\Http\Controllers\adminAuthController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\userDashboardController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [homeController::class,'home'])->name('home');

Route::get('/about',[homeController::class,'about'])->name('about');

Route::get('/sample',[homeController::class,'sample'])->name('sample');

Route::get('/contact',[homeController::class,'contact'])->name('contact');
//Register
Route::get('/register',[registerController::class,'showRegister'])->name('show.register');
Route::post('/register',[registerController::class,'register'])->name('register');
//Login
Route::get('/login',[registerController::class,'showLogin'])->name('show.login');
Route::post('/login',[registerController::class,'login'])->name('login');
Route::get('/logout',[registerController::class,'logout'])->name('logout');
Route::get('/forget-password',[registerController::class,'showForgetPassword'])->name('show.forgetPassword');
Route::post('/forget-password',[registerController::class,'forgetPassword'])->name('forgetPassword');
Route::get('/forget-password/{email}/{token}',[registerController::class,'showPasswordReset'])->name('show.passwordReset');
Route::post('/forget-password/{email}/{token}',[registerController::class,'passwordReset'])->name('passwordReset');

Route::group(['middleware'=>'userAuthCheck'],function (){
Route::get('/udashboard',[userDashboardController::class,'index']);
Route::post('/upload',[userDashboardController::class,'upload'])->name('user.upload');
Route::get('/gallery',[userDashboardController::class,'gallery'])->name('user.gallery');
Route::get('/gallery/submit-selling/{photoID}',[userDashboardController::class,'submitForSell'])->name('user.submitForSell');

    Route::get('/financial',[userDashboardController::class,'userFinancial'])->name('user.financial');
    Route::get('/financial/cashout/{amount}',[userDashboardController::class,'cashout'])->name('user.cashout');

});

Route::get('admin/login',[adminAuthController::class,'showAdminLogin'])->name('show.admin.login');
Route::post('admin/login',[adminAuthController::class,'adminLogin'])->name('admin.login');
Route::get('admin/logout',[adminAuthController::class,'adminLogout'])->name('admin.logout');

//Admin Dashboard with middleware
Route::group(['middleware'=>'adminAuth'],function (){
    Route::get('/dashboard',[adminController::class,'showDashboard'])->name('admin.dashboard.show');
    Route::get('admin/approval',[adminController::class,'approval'])->name('admin.showApproval');
    Route::get('admin/approval/status/{image_id}/{status}',[adminController::class,'updateApproval'])->name('admin.updateApproval');

    Route::get('admin/buyout',[adminController::class,'showBuyout'])->name('show.buyOut');
    Route::post('/buyout/change/status',[adminController::class,'updateBuyout'])->name('admin.updateBuyout');
    Route::get('admin/payment',[adminController::class,'paymentCheck'])->name('show.payment');
    Route::get('admin/payment/{cashoutID}/{status}',[adminController::class,'paymentCashout'])->name('status.cashOut');



});

