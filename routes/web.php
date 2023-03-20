<?php

use App\Http\Controllers\Admin\AdminInstanceController;
use App\Http\Controllers\Admin\AdminTeacherController;
use App\Http\Controllers\Admin\AdminClassroomController;
use App\Http\Controllers\Admin\AdminStudyController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminProfileController;

use App\Http\Controllers\Instance\InstanceProfileController;

use App\Http\Controllers\Teacher\TeacherProfileController;

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

    // Route::get('admin/participant/format', [AdminParticipantController::class,'format'])->name('admin.participant.format');
    // Route::post('admin/participant/import', [AdminParticipantController::class,'import'])->name('admin.participant.import');

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
});


