<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TourController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;

// ---------------------------------------All Pages---------------------------------------
Route::get('/blog-details', [IndexController::class, 'blog_details'])->name('blog-details');
Route::get('/blog', [IndexController::class, 'blog'])->name('blog');
Route::get('/cart', [IndexController::class, 'cart'])->name('cart');
Route::get('/checkout', [IndexController::class, 'checkout'])->name('checkout');
Route::get('/country', [IndexController::class, 'country'])->name('country');
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/location-1', [IndexController::class, 'location_1'])->name('location-1');
Route::get('/wishlist', [IndexController::class, 'wishlist'])->name('wishlist');
Route::get('/terms-conditions', [IndexController::class, 'terms_conditions'])->name('terms_conditions');
Route::get('/privacy-policy', [IndexController::class, 'privacy_policy'])->name('privacy_policy');
Route::post('/newsletter-save', [IndexController::class, 'newsletter_save'])->name('newsletter-save');
Route::get('/city/{slug}/details', [IndexController::class, 'city_details'])->name('city.details');
Route::get('/country/{slug}/details', [IndexController::class, 'country_details'])->name('country.details');
Route::get('/make-slug', [IndexController::class, 'make_slug']);
// ---------------------------------------All Pages---------------------------------------
// web.php
Route::get('/dump-intended-urls', function (Illuminate\Http\Request $request) {
    $intendedUrls = $request->session()->get('url.intended', []);
    dd($intendedUrls);
});


// ---------------------------------------Tours---------------------------------------
Route::prefix('tours')->name('tours.')->group(function () {
    Route::get('/details/{slug}', [TourController::class, 'details'])->name('details');
    Route::get('/listing', [TourController::class, 'listing'])->name('listing');
    Route::get('/show-more', [TourController::class, 'loadMore'])->name('loadMore');
});
// ---------------------------------------Tours---------------------------------------

// ---------------------------------------Tours---------------------------------------
Route::prefix('stories')->name('stories.')->group(function () {
    Route::get('/details/{slug}', [IndexController::class, 'storyDetails'])->name('details');
});
// ---------------------------------------Tours---------------------------------------

// ---------------------------------------User Actions---------------------------------------
Route::post('/check-account', [UserController::class, 'check_account'])->name('auth.check_account');
Route::post('/perfrom-auth', [UserController::class, 'perfrom_auth'])->name('auth.perfrom-auth');
Route::get('/logout', [UserController::class, 'logout'])->name('auth.logout');
Route::get('/email/verify/{token}', [UserController::class, 'verifyEmail'])->name('verify.email');
Route::get('/notify', [UserController::class, 'notify'])->name('notify');
Route::post('/send-reset-password-link', [UserController::class, 'send_reset_password_link'])->name('send_reset_password_link');
Route::get('/reset-password', [UserController::class, 'reset_password'])->name('reset_password');
Route::post('/reset-password', [UserController::class, 'set_new_password'])->name('set_new_password');
Route::post('/save-review', [IndexController::class, 'save_review'])->name('save_review');

// ---------------------------------------User Actions---------------------------------------

// ---------------------------------------Socialite Login---------------------------------------
Route::get('/auth/redirect/{social}', [SocialiteController::class, 'index'])->name('auth.socialite');
Route::get('/auth/callback/{social}', [SocialiteController::class, 'callback'])->name('auth.socialite.callback');
// ---------------------------------------Socialite Login---------------------------------------

require base_path('routes/admin.php');
