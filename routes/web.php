<?php

use App\Http\Controllers\QuizController;
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


//Route::post('/quizzes', QuizController::class, 'store')->name('quizzes.store');
Route::resource('quizzes', QuizController::class);
Route::get('/employee/onboarding-quiz', [QuizController::class, 'index'])->name('employee.onboarding-quiz');

Route::get('/quizzes/{quiz}/show', [QuizController::class, 'show'])->name('quizzes.show');
Route::get('/onboarding-quiz/create', [QuizController::class, 'create']);


Route::post('/quizzes/{quiz}/submit-answers', [QuizController::class, 'submitAnswers'])->name('quizzes.submit-answers');

Route::get('/quizzes/{quiz}/details', [QuizController::class, 'getDetails'])->name('quizzes.get-details');



Route::get('/quizzes/{quiz}/view-responses', [QuizController::class, 'getDetails'])->name('quizzes.view-responses');
