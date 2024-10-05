<?php

use App\Http\Controllers\Admin\AdminDashController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\Blog\BlogController;
use App\Http\Controllers\Admin\Blog\CategoriesController as BlogCategoriesController;
use App\Http\Controllers\Admin\Blog\TagsController as BlogTagsController;
use App\Http\Controllers\Admin\BulkActionController;
use App\Http\Controllers\Admin\Locations\CityController;
use App\Http\Controllers\Admin\Locations\CountryController;
use App\Http\Controllers\Admin\News\CategoriesController as NewsCategoriesController;
use App\Http\Controllers\Admin\News\NewsController;
use App\Http\Controllers\Admin\News\TagsController as NewsTagsController;
use App\Http\Controllers\Admin\RecoveryController;
use App\Http\Controllers\Admin\Tour\AttributesController;
use App\Http\Controllers\Admin\Tour\CategoriesController as TourCategoriesController;
use App\Http\Controllers\Admin\Tour\ReviewController as TourReviewController;
use App\Http\Controllers\Admin\Tour\TourController;
use Illuminate\Support\Facades\Route;

Route::get('/admins', function () {
    return redirect()->route('admin.login');
})->name('admin.admin');

Route::middleware('guest')->prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/auth', [AdminLoginController::class, 'login'])->name('admin.login');
    Route::post('/perform-login', [AdminLoginController::class, 'performLogin'])->name('admin.performLogin');
});

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    Route::post('bulk-actions/{resource}', [BulkActionController::class, 'handle'])->name('bulk-actions');
    Route::get('recovery/{resource}', [RecoveryController::class, 'index'])->name('recovery.index');

    Route::resource('blogs', BlogController::class);
    Route::get('media/{media}', [BlogController::class, 'deleteMedia'])->name('media.delete');
    Route::resource('blogs-categories', BlogCategoriesController::class);
    Route::resource('blogs-tags', BlogTagsController::class);

    Route::resource('news', NewsController::class);
    Route::resource('news-tags', NewsTagsController::class);
    Route::resource('news-categories', NewsCategoriesController::class);

    Route::resource('tours', TourController::class);
    Route::resource('tour-attributes', AttributesController::class);
    Route::resource('tour-categories', TourCategoriesController::class);
    Route::resource('tour-reviews', TourReviewController::class);

    Route::resource('countries', CountryController::class);
    Route::resource('cities', CityController::class);
});
