<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\HallsCrud;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GeneratorController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\ExamsAlgo;

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

Route::post('/auth/save', [MainController::class, 'save'])->name('auth.save');
Route::post('/auth/check', [MainController::class, 'check'])->name('auth.check');
Route::get('/auth/logout', [MainController::class, 'logout'])->name('auth.logout');

Route::group(['middleware'=>['AuthCheck']],function(){

    Route::get('/admin/dashboard', [MainController::class, 'dashboard'])->name('home');
    Route::get('/auth/login', [MainController::class, 'login'])->name('auth.login');

    Route::get('/admin/settings', [SettingsController::class, 'settings'])->name('admin.settings');
    Route::post('/admin/updateUser', [SettingsController::class, 'updateUser'])->name('updateUser');
    Route::post('/admin/updatePassword', [SettingsController::class, 'updatePassword'])->name('updatePassword');
    Route::post('/admin/updateProfileImg', [SettingsController::class, 'updateProfileImg'])->name('updateProfileImg');


    Route::get('/admin/halls', [HallsCrud::class, 'index'])->name('admin.halls');
    Route::post('admin/add', [HallsCrud::class, 'add']);
    Route::get('/admin/deleteHalls/{id}', [HallsCrud::class, 'destroy'])->name('admin.delete');
    Route::get('/admin/editHalls/{id}', [HallsCrud::class, 'editPage'])->name('admin.editHalls');
    Route::post('/admin/edit', [HallsCrud::class, 'updateHalls'])->name('admin.edit');

    Route::get('/admin/lecturers', [LecturerController::class, 'lecturers'])->name('admin.lecturers');
    Route::post('admin/addLecturer', [LecturerController::class, 'addLecturer'])->name('addLecturer');
    Route::get('/admin/delete/{id}', [LecturerController::class, 'destroy'])->name('admin.deleteLecturer');
    Route::get('/admin/editLecturer/{id}', [LecturerController::class, 'editPage'])->name('admin.editLecturer');
    Route::post('/admin/editLect', [LecturerController::class, 'updateLecturer'])->name('admin.editLect');

    Route::get('/admin/courses', [CourseController::class, 'courses'])->name('admin.courses');
    Route::post('admin/addCourse', [CourseController::class, 'addCourse'])->name('addCourse');
    Route::get('/admin/deleteCourse/{id}', [CourseController::class, 'destroy'])->name('admin.deleteCourse');
    Route::get('/admin/editCourse/{id}', [CourseController::class, 'editPage'])->name('admin.editCourse');
    Route::post('/admin/editCou', [CourseController::class, 'updateCourse'])->name('admin.editCou');

    Route::get('/admin/classes', [ClassesController::class, 'classes'])->name('admin.classes');
    Route::post('admin/addClass', [ClassesController::class, 'addClass'])->name('addClass');
    Route::get('/admin/deleteClass/{id}', [ClassesController::class, 'destroy'])->name('admin.deleteClass');
    Route::get('/admin/editClass/{id}', [ClassesController::class, 'editPage'])->name('admin.editClass');
    Route::post('/admin/editCla', [ClassesController::class, 'updateClass'])->name('admin.editCla');
    
    Route::get('/admin/generator', [GeneratorController::class, 'generator'])->name('admin.generator');
    Route::post('/admin/generateTimetable', [GeneratorController::class, 'generateTimetable'])->name('generateTimetable');

    Route::get('/admin/exams', [ExamsAlgo::class, 'index'])->name('admin.exams');
    Route::post('/admin/generateExams', [ExamsAlgo::class, 'generateExams'])->name('generateExams');
});
