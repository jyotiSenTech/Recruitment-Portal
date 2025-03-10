<?php

use App\Http\Controllers\CandidateController;
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
    Route::get('/candidate-dashboard', [CandidateController::class, 'dashboard']);
    Route::get('/submitted-applications', [CandidateController::class, 'submitted_application_list']);
    Route::post('/final-submit', [CandidateController::class, 'final_submit']);
    Route::get('/print-application/{RowID}', [CandidateController::class, 'print_application']);
    Route::get('/recruitment-list', [CandidateController::class, 'recruitment_list']);
    Route::match(['get', 'post'], '/user-register/{appID}', [CandidateController::class, 'user_register'])->name('application_submit');
    Route::match(['get', 'post'], '/user-register-awc/{appID}/{is_update?}', [CandidateController::class, 'user_register_awc'])->name('application_submit_awc');
    Route::post('/save-post', [CandidateController::class, 'savePost'])->name('savePost');
    Route::post('/save-applicant-detail', [CandidateController::class, 'saveAppDetail'])->name('saveAppDetail');
    Route::post('/save-education-detail', [CandidateController::class, 'saveEducationDetail'])->name('saveEducationDetail');
    Route::post('/save-experience-detail', [CandidateController::class, 'saveExperienceDetail'])->name('saveExperienceDetail');
    Route::post('/save-documents', [CandidateController::class, 'saveDocuments'])->name('saveDocuments');

});
