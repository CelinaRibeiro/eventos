<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;

/**
 * Route::get('/', function () {
 *   return view('welcome');
 *  });
 */


Route::get('/', [EventController::class, 'home'])->name('home');
Route::get('/events/show/{id}', [EventController::class, 'show'])->name('event.show');
Route::get('/events/create', [EventController::class, 'create'])->name('event.create')->middleware('auth');
Route::post('/events/store', [EventController::class, 'store'])->name('event.store');
Route::get('/dashboard', [EventController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::delete('/events/destroy/{id}', [EventController::class, 'destroy'])->name('event.destroy')->middleware('auth');
Route::get('/events/edit/{id}', [EventController::class, 'edit'])->name('event.edit')->middleware('auth');
Route::put('/events/update/{id}', [EventController::class, 'update'])->name('event.update')->middleware('auth');
Route::post('/events/join/{id}', [EventController::class, 'joinEvent'])->name('event.join')->middleware('auth');
Route::delete('/events/leave/{id}', [EventController::class, 'leaveEvent'])->name('event.leave')->middleware('auth');


