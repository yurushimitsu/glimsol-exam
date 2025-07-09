<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/tasks/completed', [TaskController::class, 'completedIndex'])->name('completed.index');
// Route::get('/tasks/overdue', [TaskController::class, 'overdueIndex'])->name('overdue.index');
// Route::put('/tasks/complete/{id}', [TaskController::class, 'markComplete']);
// Route::put('/tasks/pending/{id}', [TaskController::class, 'markPending']);

Route::prefix('tasks')->controller(TaskController::class)->group(function () {
    Route::get('/completed', 'completedIndex')->name('completed.index');
    Route::get('/overdue', 'overdueIndex')->name('overdue.index');
    Route::put('/complete/{id}', 'markComplete');
    Route::put('/pending/{id}', 'markPending');
});


Route::resource('tasks', TaskController::class);


