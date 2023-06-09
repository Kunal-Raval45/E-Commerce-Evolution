<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\ForgotPasswordController;


use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('admin.dashboard');
});

Route::controller(UsersController::class)->group(function () {
    Route::get('/login', 'login')->name('Users.login');
    Route::post('/login', 'loginForm')->name('Users.loginForm');


    Route::get('/register', 'register')->name('Users.register');
    Route::post('/register', 'registrationForm')->name('Users.registrationForm');

    Route::get('/addusers', 'addusers')->name('addusers');
    Route::post('/addusers', 'addusersform')->name('addusersform');


    Route::get('/users', 'viewusers')->name('viewusers');
    Route::get('/users/{id}', 'viewspecificuser')->name('viewspecificuser');

    Route::get('/edit/{id}', 'edit')->name('Users.edit');
    Route::post('/edit/{id}', 'updateForm')->name('Users.updateForm');

    Route::get('/destroy','destroy')->name('Users.destroy');


    Route::get('/logout','logout')->name('logout');


});


Route::controller(CategoryController::class)->group(function () {

    Route::get('/Category', 'Category')->name('Category.category');
    Route::get('/viewSpecificCategory/{id}', 'viewCategory')->name('Category.viewCategory');
    Route::get('/addCategory', 'viewAddCategory')->name('Category.viewAddCategory');
    Route::get('/editCategory/{id}', 'viewEditCategory')->name('Category.viewEditCategory');


    Route::post('/storecategory', 'storecategory')->name('storecategory');
    Route::post('/editcategory/{id}', 'editcategories')->name('editcategories');

});

Route::controller(CustomerController::class)->group(function (){

    Route::get('/addcustomer', 'customer_registration_form')->name('customer_registration_form');
    Route::post('/addcustomer', 'add_customers')->name('add_customers');

    Route::get('/customers', 'view_customerslist')->name('view_customerslist');
    Route::get('/customer/{id}', 'view_specific_customer')->name('view_specific_customer');

});


Route::post('api/fetch-states', [DropdownController::class, 'fetchState']);
Route::post('api/fetch-cities', [DropdownController::class, 'fetchCity']);


Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');