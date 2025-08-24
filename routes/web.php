<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\OnlionClasses;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentFeeController;
use App\Http\Controllers\TeacherController;
use App\Http\Livewire\AddParent;
use App\Http\Livewire\ShowForm;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [
            'auth',
            'localeSessionRedirect',
            'localizationRedirect',
            'localeViewPath'
        ],
        'as' => 'theme.'
    ],
    function () {
        Route::view('/', 'theme.index')->name('index');

        // Grade Route
        Route::resource('/Grade', GradeController::class);
        // Classes Route
        Route::resource('/classes', ClassController::class);
        // sections Route 
        Route::resource('/sections', SectionController::class);
        Route::get('add_parent', ShowForm::class)->name('add_parent');
        // teachers Route 
        Route::resource('/teacher', TeacherController::class);
        // Student Route 
        Route::resource('/student', StudentController::class);
        Route::get('/student_promotion/{id}',[StudentController::class, 'student_promrtion'])->name('student_promrtion');
        Route::post('/student_promotion_store', [StudentController::class, 'Store_promotion'])->name('store_promotion');
        Route::get('/Section_promotion', [StudentController::class, 'Section_promrtion'])->name('Section_promrtion');
        Route::post('/Section_promotion_store', [StudentController::class, 'Store_Section_promotion'])->name('store_Section_promotion');
        Route::get('/get-classrooms/{grade_id}', [StudentController::class, 'getClassrooms']);
        Route::get('/get-sections/{classroom_id}', [StudentController::class, 'getSections']);
        // Fee Route 
        Route::resource('/fee', FeeController::class);
        // student fee Route 
        Route::resource('/student_fee',StudentFeeController ::class);
        //  onlion classes Route 
        Route::resource('/online_classes',  OnlionClasses::class);
    }
);




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
