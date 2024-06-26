<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ForgetPassController;
use App\Http\Controllers\GoogleAuthController;
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

//aifei web.php//
Route::get('/forgetpassword', [ForgetPassController::class, 'forgotpassword_page'])->name('forgetpass');
//For continue login with google
Route::get('auth/google', [GoogleAuthController::class, 'redirect']) -> name('google-auth'); 
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callback_google']) -> name('callback_google'); 
//--Forget Password--//
Route::get('/forgot-password-page', [ForgetPassController::class, 'forgotpassword_page']) -> name('forgotpassword_page'); //display the forgot password page
Route::post('/email-notify-page', [ForgetPassController::class, 'email_notify_page']) -> name('email_notify_page'); //display the forgot password page
//for direct to reset password page 
Route::get('/reset-password/{token}', [ForgetPassController::class, 'reset_password_page']) -> name('reset_password_page'); 
Route::post('/reset-password', [ForgetPassController::class,'reset_password'])->name('reset_password');
//For reset passsword
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

//***************************//

Route::get('/discussion/homepage', [DiscussionController::class, 'homepage']) -> name('homepage');; //display discussion homepage
Route::get('/discussion/searched', [DiscussionController::class, 'searched']) -> name('searched');; //display discussion searched question page
Route::get('/discussion/typeown', [DiscussionController::class, 'typeown']) -> name('typeown');; //display discussion searched question page
Route::get('/discussion/homepage', [PostController::class, 'homepageName']) -> name('randomPost');;

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
        Route::get('/superadmin/add-account', [SuperAdminController::class, 'add_account'])->name('superadmin.add_account');
        Route::post('/superadmin/add-account', [SuperAdminController::class, 'add_accountPost'])->name('superadmin.add_account.post');
        Route::get('/superadmin/add-company', [SuperAdminController::class, 'add_company'])->name('superadmin.add_company');
        Route::post('/superadmin/add-company', [SuperAdminController::class, 'add_companyPost'])->name('superadmin.add_company.post');
        Route::get('/superadmin/manage-company', [SuperAdminController::class,'manageCompany'])->name('superadmin.manage_company');
        Route::get('/superadmin/edit-company/{id}', [SuperAdminController::class, 'editCompany'])->name('superadmin.edit_company');
        Route::post('/superadmin/edit-company', [SuperAdminController::class, 'editCompanyPost'])->name('superadmin.edit_company.post');
    });
});

//Route::get('/employee/onboarding-home-page', [EmployeeController::class, 'onboarding_home_page'])->name('onboarding_home_page');;//display the homepage 



Route::post('/modules', ModuleController::class, 'store')->name('modules.store');
Route::resource('modules', ModuleController::class);
Route::get('/employee/onboarding-home-page', [ModuleController::class, 'index'])->name('employee.onboarding-home-page');

Route::get('/modules/{module}/show', [ModuleController::class, 'show'])->name('modules.show');
Route::get('/onboarding-modules/create', [ModuleController::class, 'create']);


Route::post('/modules/{module}/submit-answers', [ModuleController::class, 'submitAnswers'])->name('modules.submit-answers');