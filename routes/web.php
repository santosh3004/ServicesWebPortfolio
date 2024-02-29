<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\AboutController;
use App\Models\About;
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

Route::get('/', function () {
    return view('frontend.index');
})->name('home');

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/logout','destroy')->name('admin.logout');
    Route::get('/admin/profile','profile')->name('admin.profile');
    Route::get('/edit/profile','editprofile')->name('edit.profile');
    Route::post('/store/profile','storeprofile')->name('store.profile');
    Route::get('/change/password','changepassword')->name('change.password');
    Route::post('/update/password','updatepassword')->name('update.password');

    Route::get('/change/password','changepassword')->name('change.password');
});

Route::controller(HomeSliderController::class)->group(function(){
    Route::get('/home/slide','homeslider')->name('home.slide');
    Route::post('/update/slider','updateslider')->name('update.slider');
});

Route::controller(AboutController::class)->group(function(){
    Route::get('/about/page','aboutpage')->name('about.page');
    Route::post('/update/about','updateabout')->name('update.about');
    Route::get('/about','homeabout')->name('home.about');
    Route::get('/about/multi/image','aboutmultiimage')->name('about.multi.image');
    Route::post('/store/multi/image','storemultiimage')->name('store.multiimage');
    Route::get('/about/all/multiimage','aboutallmultiimage')->name('about.all.multiimage');
    Route::get('/about/edit/multiimage/{id}','abouteditmultiimage')->name('about.edit.multiimage');
    Route::post('/update/multi/image','updatemultiimage')->name('update.multiimage');
    Route::get('/about/delete/multiimage/{id}','aboutdeletemultiimage')->name('about.delete.multiimage');






});

require __DIR__.'/auth.php';
