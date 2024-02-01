<?php

use App\Http\Controllers\DepartementController;
use App\Http\Controllers\HeadProgramController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TitleController;

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

Auth::routes();
Route::middleware(['auth', 'user-role:admin'])->group(function () {
    Route::get('/', [HomeController::class, 'admin'])->name('home');
    Route::get('/home', [HomeController::class, 'admin'])->name('home admin');
    //TEACHER
    Route::get('/teacher', [TeacherController::class, 'index'])->name('data dosen');
    Route::get('/teacher/create', [TeacherController::class, 'create']);
    Route::get('/teacher/{id}/update', [TeacherController::class, 'update']);
    Route::post('/teacher/save', [TeacherController::class, 'save']);
    Route::put('/teacher/{id}', [TeacherController::class, 'edit']);
    Route::delete('/teacher/{id}', [TeacherController::class, 'delete']);

    //HEAD-PROGRAM
    Route::get('/head-program', [HeadProgramController::class, 'index'])->name('data ketjur');
    Route::post('/head-program/{id}/set-user', [HeadProgramController::class, 'save']);
    Route::post('/head-program/{id}/delete-user', [HeadProgramController::class, 'delete']);


    //SKILL
    Route::get('/skill', [SkillController::class, 'index'])->name('data skill');
    Route::get('/skill/create', [SkillController::class, 'create']);
    Route::get('/skill/{id}/update', [SkillController::class, 'update']);
    Route::post('/skill/save', [SkillController::class, 'save']);
    Route::put('/skill/{id}', [SkillController::class, 'edit']);
    Route::delete('/skill/{id}', [SkillController::class, 'delete']);


    //POSITON
    Route::get('/position', [PositionController::class, 'index'])->name('data position');
    Route::get('/position/create', [PositionController::class, 'create']);
    Route::get('/position/{id}/update', [PositionController::class, 'update']);
    Route::post('/position/save', [PositionController::class, 'save']);
    Route::put('/position/{id}', [PositionController::class, 'edit']);
    Route::delete('/position/{id}', [PositionController::class, 'delete']);

    //DEPARTEMENT
    Route::get('/departement', [DepartementController::class, 'index'])->name('data departement');
    Route::get('/departement/create', [DepartementController::class, 'create']);
    Route::get('/departement/{id}/update', [DepartementController::class, 'update']);
    Route::post('/departement/save', [DepartementController::class, 'save']);
    Route::put('/departement/{id}', [DepartementController::class, 'edit']);
    Route::delete('/departement/{id}', [DepartementController::class, 'delete']);

    //TITLE
    Route::get('/title', [TitleController::class, 'index'])->name('data title');
    Route::get('/title/create', [TitleController::class, 'create']);
    Route::get('/title/{id}/update', [TitleController::class, 'update']);
    Route::get('/title/{id}/proposal', [TitleController::class, 'update_proposal']);
    Route::get('/title/{id}/skripsi', [TitleController::class, 'update_skripsi']);
    Route::post('/title/save', [TitleController::class, 'save']);
    Route::put('/title/{id}', [TitleController::class, 'edit']);
    Route::delete('/title/{id}', [TitleController::class, 'delete']);
});

Route::middleware(['auth', 'user-role:ketjur'])->group(function () {
    Route::get('/ketjur', [HomeController::class, 'ketjur'])->name('home ketjur');
    Route::get('/ketjur/home', [HomeController::class, 'ketjur'])->name('home ketjur');
});
