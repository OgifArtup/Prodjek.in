<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkspaceController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('main');
})->middleware('guest');

Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest');

// Google Authentication
Route::get('/auth/google',[GoogleController::class, 'redirectToGoogle'])->name('googleLogin');
Route::get('/auth/google/callback',[GoogleController::class, 'handleGoogleCallback'])->name('handleGoogleCallback');

// Manual Login
Route::post('/manual-login', [UserController::class, 'manualLogin'])->name('manualLogin');

// Route::get('/register', [UserController::class, 'register'])->name('register');

// Logout
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function(){
    Route::get('/home', [WorkspaceController::class, 'viewHome'])->name('viewHome');
    Route::get('/first-time', [GoogleController::class, 'firstTimeLogin'])->name('firstTimeLogin');
    Route::post('/make-pass', [GoogleController::class, 'makePassword'])->name('makePassword');
    
    Route::get('/project-list', [WorkspaceController::class, 'viewProjects'])->name('viewProjects');
    Route::post('/add-project', [WorkspaceController::class, 'createProject'])->name('createProject');
    
    Route::post('/invite-member/{id}', [WorkspaceController::class, 'inviteMember'])->name('inviteMember');

    Route::get('/project-details/{id}', [WorkspaceController::class, 'viewDetails'])->name('viewDetails');
    Route::post('/add-task/{id}', [WorkspaceController::class, 'createTask'])->name('createTask');
    Route::patch('/check-task/{id}', [WorkspaceController::class, 'checkTask'])->name('checkTask');
    Route::patch('/uncheck-task/{id}', [WorkspaceController::class, 'uncheckTask'])->name('uncheckTask');
    Route::delete('/delete-task/{id}', [WorkspaceController::class, 'deleteTask'])->name('deleteTask');
    
    Route::post('/add-assigned-member/{id}', [WorkspaceController::class, 'addAssignedMembers'])->name('addAssignedMembers');
    Route::delete('/delete-assigned-member', [WorkspaceController::class, 'deleteAssignedMember'])->name('deleteAssignedMember');
});
