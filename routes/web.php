<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Top-Level/Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');


Route::get('/about', function(){ return Inertia::render('Top-Level/About'); })->name('about');

Route::resource('/contact', 'App\Http\Controllers\EmailController')->names(['index' => 'contact', 'store' => 'send']);

# Playground Routes
Route::resource('weather', 'App\Http\Controllers\WeatherController')->names(['index' => 'weather']);
Route::get("/other", function(){ return Inertia::render("Playground/Other");} )->name('other');
Route::resource('payments', 'App\Http\Controllers\AuthorizeDotNetController')->names(['index' => 'payments']);



Route::resource("/users", "App\Http\Controllers\UserController")->middleware(['admin']);
Route::resource("/profile", "App\Http\Controllers\ProfileController")->middleware(['auth']);
Route::get('my/gallary', [App\Http\Controllers\ProfileController::class, 'showGallary'])->name('profile.gallery');
Route::get('set/image/{id}', [App\Http\Controllers\ProfileController::class, 'setImage'])->name('profile.image');


// Index is a public route...the rest are admin only.  (see the constructor)
Route::resource('/projects', 'App\Http\Controllers\ProjectController')->names(['index' => 'projects']);


Route::resource('/images', 'App\Http\Controllers\ImageController');



Route::middleware(['auth', 'verified'])->group(function(){

    route::get('/dashboard', function(){

        $user = auth()->user()->toStandardClass();
        return Inertia::render('Top-Level/Dashboard', ['user' => $user]);
    })->name('dashboard');
});


Route::get("delete/account", [App\Http\Controllers\UserController::class, 'deleteAccount'])->name('account.delete');

require __DIR__.'/auth.php';
