<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkspaceController;

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
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/project-list', [WorkspaceController::class, 'viewProjects'])->name('viewProjects');
Route::post('/add-project', [WorkspaceController::class, 'createProject'])->name('createProject');

Route::get('/project-details/{id}', [WorkspaceController::class, 'viewDetails'])->name('viewDetails');
Route::post('/add-task/{id}', [WorkspaceController::class, 'createTask'])->name('createTask');
Route::patch('/check-task/{id}', [WorkspaceController::class, 'checkTask'])->name('checkTask');
Route::patch('/uncheck-task/{id}', [WorkspaceController::class, 'uncheckTask'])->name('uncheckTask');
Route::delete('/delete-task/{id}', [WorkspaceController::class, 'deleteTask'])->name('deleteTask');

Route::post('/add-assigned-member/{id}', [WorkspaceController::class, 'addAssignedMembers'])->name('addAssignedMembers');
Route::delete('/delete-assigned-member', [WorkspaceController::class, 'deleteAssignedMember'])->name('deleteAssignedMember');