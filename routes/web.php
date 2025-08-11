<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});

Route::get('/register-company', [CompanyController::class,'create'])->name('company.create');
Route::post('/register-company', [CompanyController::class,'store'])->name('company.store');

Route::middleware(['auth','isAdmin'])->group(function(){
    // Route::get('/admin/dashboard', [AdminController::class,'index'])->name('admin.dashboard');
    // Route::resource('/admin/users', UserController::class); // CRUD user
    Route::get('/admin/company/edit', [CompanyController::class,'edit'])->name('company.edit');
    Route::put('/admin/company', [CompanyController::class,'update'])->name('company.update');
});

Route::middleware(['auth','isStaff'])->group(function(){
    // Route::get('/staff/dashboard', [StaffController::class,'index'])->name('staff.dashboard');
});

require __DIR__.'/auth.php';
