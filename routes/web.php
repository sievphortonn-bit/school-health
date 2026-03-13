<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\PatientVisitController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentGradeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard'); // or home
    }
    return redirect()->route('login');
});

/* AUTH */
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

/* PROTECTED ROUTES */
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    Route::get('/dashboard/stats', [DashboardController::class,'stats']);
    // 🔥 STUDENT SEARCH (NAMED)
    Route::get('/students/search', [StudentController::class, 'search'])
        ->name('students.search');

    // STUDENT CRUD
    Route::resource('students', StudentController::class);

    // 🔥 TEACHER SEARCH (NAMED)
    Route::get('/teachers/search', [TeacherController::class, 'search'])
        ->name('teachers.search');
    // routes/web.php
    Route::get('/teachers/filter', [TeacherController::class, 'filter']);

    // TEACHER CRUD
    Route::resource('teachers', TeacherController::class);
//      Route::get('/patient-visits', [PatientVisitController::class, 'index']);
//     Route::post('/patient-visits', [PatientVisitController::class, 'store']);

    
//    Route::put('/patient-visits/{patientVisit}', [PatientVisitController::class,'update']);
// Route::delete('/patient-visits/{patientVisit}', [PatientVisitController::class,'destroy']);
Route::get('/patients/ajax', [PatientController::class, 'ajax'])
    ->name('patients.ajax');
 Route::get('/patients', [PatientController::class,'index'])
        ->name('patients.index');

    Route::get('/patients/create', [PatientController::class,'create'])
        ->name('patients.create');

    Route::post('/patients', [PatientController::class,'store'])
        ->name('patients.store');

    Route::get('/patients/{patient}', [PatientController::class,'show'])
        ->name('patients.show');

    Route::get('/patients/{patient}/edit', [PatientController::class,'edit'])
        ->name('patients.edit');

    Route::put('/patients/{patient}', [PatientController::class,'update'])
        ->name('patients.update');
    // 🔥 ADD PATIENT HISTORY (THIS ONE YOU NEED)
    Route::post('/patients/{patient}/history', 
        [PatientController::class, 'storeHistory'])
        ->name('patients.history.store');
    Route::delete('/history/{history}', [PatientController::class, 'destroyHis'])
    ->name('history.destroy');
    Route::put('/history/{history}', [PatientController::class, 'updateHis'])
    ->name('history.update');
    Route::delete('/patients/{patient}', [PatientController::class,'destroy'])
        ->name('patients.destroy');


    //report
     Route::get('/report',[PatientReportController::class, 'index'])->name('patients.report');


    Route::get('/patients/report/print',[PatientReportController::class,'print'])->name('patients.report.print');

    Route::get('/patients/report/excel',[PatientReportController::class,'excel'])->name('patients.report.excel');
    // web.php
    

    Route::get('/staff/search', [StaffController::class,'search'])
        ->name('staff.search');

    Route::resource('staff', StaffController::class);
     Route::get('/all', [StudentDashboardController::class, 'index'])
            ->name('students.all');

        Route::get('/grade/{grade}', [StudentGradeController::class, 'index'])
            ->name('students.grade');

    Route::prefix('students')->group(function () {
    Route::get('/{student}/edit', [StudentGradeController::class, 'edit'])
    ->name('students.edit');
    Route::put('/{student}', [StudentGradeController::class, 'update'])
        ->name('students.update');

       
    });

    // Print all histories of patient
    Route::get('/patients/{patient}/print', 
        [PatientController::class, 'printAll']
    )->name('patients.print');

    // Print single history
    Route::get('/history/{history}/print', 
        [PatientController::class, 'printHistory']
    )->name('patients.print.history');



});
