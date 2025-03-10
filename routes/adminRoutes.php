<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMasterController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\CheckLogin;
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

Route::middleware([CheckLogin::class])->group(function () {
    // Route::group(['middleware' => 'check.adminAuth'], function () {

    Route::get('/admin-dashboard', [AdminController::class, 'dashboard']);
    Route::post('/validate-user', [LoginController::class, 'validate_user']);
    Route::get('/application-list/{pref_dist?}', [AdminController::class, 'application_list']);
    Route::get('/verified-list/{pref_dist?}', [AdminController::class, 'verified_list']);
    Route::get('/rejected-list/{pref_dist?}', [AdminController::class, 'rejected_list']);
    Route::get('/view-application-detail/{applicant_id}', [AdminController::class, 'view_application_detail']);
    Route::get('/view-docs/{applicant_id}', [AdminController::class, 'view_docs']);
    Route::get('/merit-list', [AdminController::class, 'merit_list']);
    Route::match(['get', 'post'], '/marks-entry', [AdminController::class, 'marks_entry'])->name('admin.marks-entry');;
    Route::post('/approve-reject-application', [AdminController::class, 'applicationApproveReject']);
    Route::get('/applications-list', [AdminController::class, 'district_wise_applications']);

    ////////////  Master Entry Routes ///////////////

    Route::match(['get', 'post'], '/add-district', [AdminMasterController::class, 'add_district'])->name('admin.add_district');;
    Route::match(['get', 'post'], '/add-project', [AdminMasterController::class, 'add_project'])->name('admin.add_project');;
    Route::match(['get', 'post'], '/add-sector', [AdminMasterController::class, 'add_sector'])->name('admin.add_sector');;
    Route::match(['get', 'post'], '/add-awc', [AdminMasterController::class, 'add_awc'])->name('admin.add_awc');;
    Route::post('/get-project', [AdminMasterController::class, 'get_project']);
    Route::post('/get-sector', [AdminMasterController::class, 'get_sector']);
    Route::post('/get-awc', [AdminMasterController::class, 'get_awc']);

});
