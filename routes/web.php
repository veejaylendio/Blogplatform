<?php

use App\Models\About;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Expertise;
use App\Models\HeaderSocialURLS;
use Illuminate\Support\Facades\Route;
use App\Models\HeaderText;
use App\Http\Controllers\Management\ExperienceController;
use App\Http\Controllers\Management\WorksController;
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
    $about = About::first();
    $expertises = Expertise::all();
    $educations = Education::all();
    $experiences = Experience::all();
    return view('welcome', compact('headerText','socials', 'about', 'expertises', 'educations', 'experiences'));
})->name('welcome');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/headerText', [App\Http\Controllers\ManagementController::class, 'headerText'])->name('headerText')->middleware('auth');
Route::post('/updateHeaderText', [App\Http\Controllers\ManagementController::class, 'updateHeaderText'])->name('updateHeaderText')->middleware('auth');

Route::group(['prefix' => 'social'], function () {
    Route::get('/', [App\Http\Controllers\Management\SocialController::class, 'index'])->name('social.index')->middleware('auth');
    Route::post('store', [App\Http\Controllers\Management\SocialController::class, 'store'])->name('social.store')->middleware('auth');
    Route::get('edit/{id}', [App\Http\Controllers\Management\SocialController::class, 'edit'])->name('social.edit')->middleware('auth');
    Route::post('update/{id}', [App\Http\Controllers\Management\SocialController::class, 'update'])->name('social.update')->middleware('auth');
    Route::delete('delete/{id}', [App\Http\Controllers\Management\SocialController::class, 'destroy'])->name('social.destroy')->middleware('auth');
});

Route::group(['prefix' => 'about'], function () {
    Route::get('/', [App\Http\Controllers\Management\AboutController::class, 'index'])->name('about.index')->middleware('auth');
    Route::post('store', [App\Http\Controllers\Management\AboutController::class, 'store'])->name('about.store')->middleware('auth');
    Route::post('update', [App\Http\Controllers\Management\AboutController::class, 'update'])->name('about.update')->middleware('auth');
});

Route::group(['prefix' => 'expertise'], function () {
    Route::get('/', [App\Http\Controllers\Management\ExpertiseController::class, 'index'])->name('expertise.index')->middleware('auth');
    Route::post('store', [App\Http\Controllers\Management\ExpertiseController::class, 'store'])->name('expertise.store')->middleware('auth');
    Route::get('edit/{id}', [App\Http\Controllers\Management\ExpertiseController::class, 'edit'])->name('expertise.edit')->middleware('auth');
    Route::post('update/{id}', [App\Http\Controllers\Management\ExpertiseController::class, 'update'])->name('expertise.update')->middleware('auth');
    Route::delete('delete/{id}', [App\Http\Controllers\Management\ExpertiseController::class, 'destroy'])->name('expertise.destroy')->middleware('auth');
});

Route::group(['prefix' => 'education'], function () {
    Route::get('/', [App\Http\Controllers\Management\EducationController::class, 'index'])->name('education.index')->middleware('auth');
    Route::get('create', [App\Http\Controllers\Management\EducationController::class, 'create'])->name('education.create')->middleware('auth');
    Route::post('store', [App\Http\Controllers\Management\EducationController::class, 'store'])->name('education.store')->middleware('auth');
    Route::get('edit/{id}', [App\Http\Controllers\Management\EducationController::class, 'edit'])->name('education.edit')->middleware('auth');
    Route::post('update/{id}', [App\Http\Controllers\Management\EducationController::class, 'update'])->name('education.update')->middleware('auth');
    Route::delete('delete/{id}', [App\Http\Controllers\Management\EducationController::class, 'destroy'])->name('education.destroy')->middleware('auth');
});

Route::resource('experience',ExperienceController::class)->middleware('auth');
Route::resource('works',WorksController::class)->middleware('auth');
