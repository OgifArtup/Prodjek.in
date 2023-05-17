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
Route::post('/add-task', [WorkspaceController::class, 'createTask'])->name('createTask');