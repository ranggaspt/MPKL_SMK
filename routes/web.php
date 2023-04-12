<?php

use App\Http\Controllers\Admin\AdminInstanceController;
use App\Http\Controllers\Admin\AdminTeacherController;
use App\Http\Controllers\Admin\AdminClassroomController;
use App\Http\Controllers\Admin\AdminStudyController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminProfileController;

use App\Http\Controllers\Instance\InstanceProfileController;
use App\Http\Controllers\Instance\InstanceComplaintController;
use App\Http\Controllers\Instance\InstanceJournalController;
use App\Http\Controllers\Instance\InstanceMonitoringController;

use App\Http\Controllers\Teacher\TeacherAttendanceController;
use App\Http\Controllers\Teacher\TeacherComplaintController;
use App\Http\Controllers\Teacher\TeacherJournalController;
use App\Http\Controllers\Teacher\TeacherMonitoringController;
use App\Http\Controllers\Teacher\TeacherProfileController;
use App\Http\Controllers\Teacher\TeacherReportController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth','user-access:super'])->group(function () {
    Route::resource('admin/student', AdminStudentController::class)->names('admin.student');
    Route::resource('admin/instance', AdminInstanceController::class)->names('admin.instance');
    Route::resource('admin/teacher', AdminTeacherController::class)->names('admin.teacher');
    Route::resource('admin/classroom', AdminClassroomController::class)->names('admin.classroom');
    Route::resource('admin/study', AdminStudyController::class)->names('admin.study');
    Route::get('/admin/profile', [AdminProfileController::class,'index'])->name('admin.profile');
    Route::put('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
});

Route::middleware(['auth','user-access:teacher'])->group(function(){
    Route::get('/teacher/profile', [TeacherProfileController::class,'index'])->name('teacher.profile');
    Route::put('/teacher/profile', [TeacherProfileController::class, 'update'])->name('teacher.profile.update');
});

Route::middleware(['auth','user-access:instance'])->group(function(){
    Route::get('/instance/profile', [InstanceProfileController::class,'index'])->name('instance.profile');
    Route::put('/instance/profile', [InstanceProfileController::class, 'update'])->name('instance.profile.update');
    Route::resource('instance/complaint', InstanceComplaintController::class)->names('instance.complaint');
    Route::resource('instance/journal', InstanceJournalController::class)->names('instance.journal');
    Route::resource('instance/monitoring', InstanceMonitoringController::class)->names('instance.monitoring');
});

Route::middleware(['auth','user-access:teacher'])->group(function(){
    Route::get('/teacher/profile', [TeacherProfileController::class,'index'])->name('teacher.profile');
    Route::put('/teacher/profile', [TeacherProfileController::class, 'update'])->name('teacher.profile.update');
    Route::resource('teacher/attendance', TeacherAttendanceController::class)->names('teacher.attendance');
    Route::resource('teacher/complaint', TeacherComplaintController::class)->names('teacher.complaint');
    Route::resource('teacher/journal', TeacherJournalController::class)->names('teacher.journal');
    Route::resource('teacher/monitoring', TeacherMonitoringController::class)->names('teacher.monitoring');
    Route::resource('teacher/report', TeacherReportController::class)->names('teacher.report');
});


