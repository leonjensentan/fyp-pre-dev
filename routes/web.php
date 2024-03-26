<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ModuleController;
use App\Http\Requests\StoreModuleRequest;
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

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['web', 'auth'])->group(function () {
    // Common authenticated user routes (both admin and employee)

    Route::middleware(['admin'])->group(function () {
        // Routes specific to admin
        Route::get('/admin/profile-page', [AdminController::class, 'profile_page'])->name('admin.profile_page');
        Route::get('/admin/manage-account', [AdminController::class, 'manage_account'])->name('manage_account');
        Route::get('/admin/add-account', [AdminController::class, 'add_account'])->name('add_account');
        Route::post('/admin/add-account', [AdminController::class, 'add_accountPost'])->name('add_account.post');
        Route::get('/admin/edit-account/{id}', [AdminController::class, 'editAccount'])->name('admin.edit_account');
        Route::post('/admin/edit-account/{id}', [AdminController::class, 'editAccountPost'])->name('admin.edit_account.post');
        Route::get('/admin/delete_account/{id}', [AdminController::class, 'deleteAccount'])->name('admin.delete_account');
        Route::post('/admin/update-profile', [AdminController::class, 'updateProfile'])->name('admin.update-profile');

    });

    Route::middleware(['employee'])->group(function () {
        // Routes specific to employee
        Route::get('/employee/profile-page', [EmployeeController::class, 'profile_page'])->name('employee.profile_page');
    });

    Route::middleware(['superadmin'])->group(function () {
        // Routes specific to superadmin
        Route::get('/superadmin/profile-page', [SuperAdminController::class, 'profile_page'])->name('superadmin.profile_page');
        Route::get('/superadmin/manage-account', [SuperAdminController::class,'manageAccount'])->name('superadmin.manage_account');

    });
});

//Route::get('/employee/onboarding-home-page', [EmployeeController::class, 'onboarding_home_page'])->name('onboarding_home_page');;//display the homepage 



Route::post('/modules', ModuleController::class, 'store')->name('modules.store');
Route::resource('modules', ModuleController::class);
Route::get('/employee/onboarding-home-page', [ModuleController::class, 'index'])->name('employee.onboarding-home-page');

Route::get('/modules/{module}/show', [ModuleController::class, 'show'])->name('modules.show');
Route::get('/onboarding-modules/create', [ModuleController::class, 'create']);


Route::post('/modules/{module}/submit-answers', [ModuleController::class, 'submitAnswers'])->name('modules.submit-answers');