<?php

use Illuminate\Support\Facades\Route;
use App\Models\HeaderText;
// use Inertia\Inertia;



// Route::get('dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// require __DIR__.'/settings.php';
// require __DIR__.'/auth.php';

Auth::routes();

Route::get('/', function () {
    $headerText = HeaderText::first();
    return view('welcome', compact('headerText'));
})->name('welcome');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/headerText', [App\Http\Controllers\ManagementController::class, 'headerText'])->name('headerText');
Route::post('/updateHeaderText', [App\Http\Controllers\ManagementController::class, 'updateHeaderText'])->name('updateHeaderText');
Route::get('/socialURL', [App\Http\Controllers\ManagementController::class, 'socialURL'])->name('socialURL');
Route::post('/addSocialURL', [App\Http\Controllers\ManagementController::class, 'addSocialURL'])->name('addSocialURL');
Route::get('/addSocialURL/edit/{id}', [App\Http\Controllers\ManagementController::class, 'editSocialURL'])->name('editSocialURL');
