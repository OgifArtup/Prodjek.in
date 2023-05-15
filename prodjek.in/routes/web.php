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

Route::get('/project-details', function () {
    return view('detail_prodjek');
});

Route::get('/project-list', [WorkspaceController::class, 'viewProjects'])->name('viewProjects');
Route::post('/add-project', [WorkspaceController::class, 'createProject'])->name('createProject');