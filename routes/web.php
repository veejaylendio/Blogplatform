<?php

use App\Models\HeaderSocialURLS;
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
    $socials = HeaderSocialURLS::all();
    return view('welcome', compact('headerText','socials'));
})->name('welcome');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/headerText', [App\Http\Controllers\ManagementController::class, 'headerText'])->name('headerText');
Route::post('/updateHeaderText', [App\Http\Controllers\ManagementController::class, 'updateHeaderText'])->name('updateHeaderText');

Route::group(['prefix' => 'social'], function () {
    Route::get('/', [App\Http\Controllers\Management\SocialController::class, 'index'])->name('social.index');
    Route::post('store', [App\Http\Controllers\Management\SocialController::class, 'store'])->name('social.store');
    Route::get('edit/{id}', [App\Http\Controllers\Management\SocialController::class, 'edit'])->name('social.edit');
    Route::post('update/{id}', [App\Http\Controllers\Management\SocialController::class, 'update'])->name('social.update');
    Route::delete('delete/{id}', [App\Http\Controllers\Management\SocialController::class, 'destroy'])->name('social.destroy');
});

Route::group(['prefix' => 'about'], function () {
    Route::get('/', [App\Http\Controllers\Management\SocialController::class, 'index'])->name('about.index');
    Route::post('store', [App\Http\Controllers\Management\SocialController::class, 'store'])->name('about.store');

});
