<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\User;

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

//Landing Page
Route::get('/', [AuthController::class, 'landHandling'])->name('landHandling');

//Login-Register Handling
Route::get('/register', [AuthController::class, 'registerPage'])->name('registerPage');
Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::get('/login', [AuthController::class, 'loginPage'])->name('loginPage');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//All Role Side
Route::get('/homepage', [AuthController::class, 'homePage'])->name('homePage');
Route::post('/homepage/search', [AuthController::class, 'homepageSearch'])->name('homepageSearch');

//Admin Side
Route::group(['middleware' => Admin::class], function () {
    
    Route::get('/admin/dashboard', [AdminController::class, 'dashboardPage'])->name('dashboardPage');

    /* ======================== ADMIN-USER ======================== */
    Route::get('/admin/user/user-entries', [AdminController::class, 'userPage'])->name('userPage');
    Route::get('/admin/user/user-create', [AdminController::class, 'userCreatePage'])->name('userCreatePage');
    Route::get('/admin/user/user-edit/{id}', [AdminController::class, 'userEditPage'])->name('userEditPage');
    
    //CREATE USER
    Route::post('/admin/user/user-create', [AdminController::class, 'createUser'])->name('admin.user.create');
    
    //EDIT USER
    Route::post('/admin/user/user-update/{id}', [AdminController::class, 'updateUser'])->name('userUpdate');
    
    //SEARCH USER
    Route::post('/admin/user/search', [AdminController::class, 'userSearch'])->name('userSearch');

    //DELETE USER
    Route::get('/admin/user/delete/{id}', [AdminController::class, 'userDelete'])->name('userDelete');

    //History USER
    Route::get('/admin/user/history/{id}', [AdminController::class, 'userHistoryPage'])->name('admin.userHistoryPage');



    /* ======================== ADMIN-INSTRUMENT ======================== */
    Route::get('/admin/instrument/instrument-entries', [AdminController::class, 'instrumentPage'])->name('instrumentPage');
    Route::get('/admin/instrument/instrument-create', [AdminController::class, 'instrumentCreatePage'])->name('instrumentCreatePage');
    Route::get('/admin/instrument/instrument-edit/{id}', [AdminController::class, 'instrumentEditPage'])->name('instrumentEditPage');

    //CREATE INSTRUMENT
    Route::post('/admin/instrument/instrument-create', [AdminController::class, 'createInstrument'])->name('admin.instrument.create');

    //SEARCH INSTRUMENT
    Route::post('/admin/instrument/search', [AdminController::class, 'instrumentSearch'])->name('instrumentSearch');

    //EDIT INSTRUMENT
    Route::post('/admin/instrument/instrument-update/{id}', [AdminController::class, 'updateInstrument'])->name('instrumentUpdate');

    //DELETE INSTRUMENT
    Route::get('/admin/instrument/delete/{id}', [AdminController::class, 'instrumentDelete'])->name('instrumentDelete');

    /* ======================== ADMIN-CATEGORY ======================== */
    Route::get('/admin/categories/categories-entries', [AdminController::class, 'categoryPage'])->name('categoryPage');
    Route::get('/admin/categories/categories-create', [AdminController::class, 'categoryCreatePage'])->name('categoryCreatePage');
    Route::get('/admin/categories/categories-edit/{id}', [AdminController::class, 'categoryEditPage'])->name('categoryEditPage');

    //CREATE CATEGORY
    Route::post('/admin/categories/category-create', [AdminController::class, 'createCategory'])->name('admin.category.create');
    
    //EDIT CATEGORY
    Route::post('/admin/categories/category-update/{id}', [AdminController::class, 'updateCategory'])->name('categoryUpdate');

    //SEARCH CATEGORY
    Route::post('/admin/categories/search', [AdminController::class, 'categorySearch'])->name('categorySearch');

    //DELETE CATEGORY
    Route::get('/admin/categories/delete/{id}', [AdminController::class, 'categoryDelete'])->name('categoryDelete');

    /* ======================== ADMIN-RESERVATION ======================== */
    Route::get('/admin/peminjaman/reservation-entries', [AdminController::class, 'reservationPage'])->name('reservationPage');
    Route::get('/admin/reservation', [AdminController::class, 'reservationPage'])->name('admin.reservation');
    Route::post('/admin/return-instrument/{id}', [AdminController::class, 'returnInstrument'])->name('admin.returnInstrument');
    Route::delete('/admin/delete-reservation/{id}', [AdminController::class, 'deleteReservation'])->name('deleteReservation');
    Route::post('/admin/reservations/search', [AdminController::class, 'searchReservations'])->name('searchReservations');




    
});

//User Side
Route::group(['middleware' => User::class], function () {
    
    Route::get('/user/myprofile/{id}', [UserController::class, 'myProfilePage'])->name('myProfilePage');
    Route::get('/user/myreservation', [UserController::class, 'viewReservationHistory'])->name('viewReservationHistory');

    //EDIT PROFILE
    Route::post('/user/myprofile/edit-profile/{id}', [UserController::class, 'updateProfile'])->name('updateProfile');
    
    //EDIT SECURITY
    Route::post('/user/myprofile/edit-security/{id}', [UserController::class, 'updateSecurity'])->name('updateSecurity');
    
    //DELETE USER
    Route::post('/user/myprofile/delete/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');

    //NEW RESERVATION
    Route::post('/user/reservation/create/{instrumentId}', [UserController::class, 'createReservation'])->name('createReservation');

});