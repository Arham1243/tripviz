<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminDashController;
use App\Http\Controllers\Admin\SiteSettingsController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\FrontEndEditorController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Admin\Locations\ContinentController;
use App\Http\Controllers\Admin\Locations\CountryController;
use App\Http\Controllers\Admin\Locations\CityController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\TourController;


use App\Http\Controllers\Admin\Tour\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\Tour\TourController as AdminTourController;
use App\Http\Controllers\Admin\Tour\FaqController as AdminTourFaqController;
use App\Http\Controllers\Admin\Tour\ItineraryController as AdminTourItineraryController;
use App\Http\Controllers\Admin\Tour\AttributesController as AdminTourAttributesController;
use App\Http\Controllers\Admin\Tour\InclusionController as AdminTourInclusionController;
use App\Http\Controllers\Admin\Tour\ExclusionController as AdminTourExclusionController;
use App\Http\Controllers\Admin\Tour\AdditionalController as AdminToursAdditionalController;
use App\Http\Controllers\Admin\Tour\AdditionalItemController as AdminAdditionalItemController;
use App\Http\Controllers\Admin\Tour\ReviewController as AdminTourReviewController;
use App\Http\Controllers\Admin\PromotionController as AdminPromotionController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;


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



// ---------------------------------------Tours---------------------------------------
Route::prefix('tours')->name('tours.')->group(function () {
   Route::get('/details/{slug}', [TourController::class, 'details'])->name('details');
   Route::get('/listing', [TourController::class, 'listing'])->name('listing');
   Route::get('/show-more', [TourController::class, 'loadMore'])->name('loadMore');
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




// ---------------------------------------Admin---------------------------------------

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


   // ---------------------------------------Logo Management---------------------------------------
   Route::get('/logo-management', [SiteSettingsController::class, 'showLogo'])->name('showLogo');
   Route::post('/logo-management-save', [SiteSettingsController::class, 'saveLogo'])->name('saveLogo');
   // ---------------------------------------Logo Management---------------------------------------


   // ---------------------------------------Social Management---------------------------------------
   Route::get('/contact-social-info', [SiteSettingsController::class, 'socialInfo'])->name('socialInfo');
   Route::post('/contact-social-info', [SiteSettingsController::class, 'saveSocialInfo'])->name('saveSocialInfo');
   // ---------------------------------------Social Management---------------------------------------

   // ---------------------------------------User Management---------------------------------------
   Route::get('/users-listing', [AdminDashController::class, 'usersListing'])->name('usersListing');
   Route::get('/view-user/{id}', [AdminDashController::class, 'editUser'])->name('editUser');
   Route::get('/suspend-user/{id}', [AdminDashController::class, 'suspendUser'])->name('suspendUser');
   Route::get('/delete-user/{id}', [AdminDashController::class, 'deleteUser'])->name('deleteUser');
   // ---------------------------------------User Management---------------------------------------

   // ---------------------------------------cms  Management---------------------------------------
   Route::post('/statusAjaxUpdateCustom', [FrontEndEditorController::class, 'statusAjaxUpdateCustom']);
   Route::post('/statusAjaxUpdate', [FrontEndEditorController::class, 'statusAjaxUpdate']);
   Route::post('/updateFlagOnKey', [FrontEndEditorController::class, 'updateFlagOnKey']);
   Route::post('/imageUpload', [FrontEndEditorController::class, 'imageUpload']);

   // ---------------------------------------cms Management---------------------------------------


   // ---------------------------------------continents management---------------------------------------
   Route::resource('continents', ContinentController::class);
   Route::get('continents/{continent}/suspend', [ContinentController::class, 'suspend'])->name('continents.suspend');
   // ---------------------------------------continents management---------------------------------------

   // ---------------------------------------country management---------------------------------------
   Route::resource('countries', CountryController::class);
   Route::get('countries/{country}/suspend', [CountryController::class, 'suspend'])->name('countries.suspend');
   // ---------------------------------------country management---------------------------------------

   // ---------------------------------------cities management---------------------------------------
   Route::resource('cities', CityController::class);
   Route::get('cities/{city}/suspend', [CityController::class, 'suspend'])->name('cities.suspend');
   // ---------------------------------------cities management---------------------------------------


   // ---------------------------------------newsletter management---------------------------------------
   Route::get('/newsletters', [NewsletterController::class, 'index'])->name('newsletters');
   Route::get('/newsletters/{newsletter}/suspend', [NewsletterController::class, 'suspend'])->name('newsletters.suspend');
   Route::delete('/newsletters/{newsletter}', [NewsletterController::class, 'destroy'])->name('newsletters.destroy');
   // ---------------------------------------country management---------------------------------------


   // ---------------------------------------categories management---------------------------------------
   Route::resource('categories', AdminCategoryController::class);
   Route::get('categories/{id}/suspend', [AdminCategoryController::class, 'suspend'])->name('categories.suspend');
   // ---------------------------------------categories management---------------------------------------


   // ---------------------------------------tours management---------------------------------------
   Route::resource('tours', AdminTourController::class);
   Route::get('tours/{id}/suspend', [AdminTourController::class, 'suspend'])->name('tours.suspend');
   Route::post('tours/save-highlights', [AdminTourController::class, 'save_highlights'])->name('tours.save_highlights');
   // ---------------------------------------tours management---------------------------------------

   // ---------------------------------------tours faqs management---------------------------------------
   Route::resource('tours-faqs', AdminTourFaqController::class);
   Route::get('tours-faqs/{id}/suspend', [AdminTourFaqController::class, 'suspend'])->name('tours-faqs.suspend');
   // ---------------------------------------tours_faqs management---------------------------------------

   // ---------------------------------------tours itineraries management---------------------------------------
   Route::resource('tours-itineraries', AdminTourItineraryController::class);
   Route::get('tours-itineraries/{id}/suspend', [AdminTourItineraryController::class, 'suspend'])->name('tours-itineraries.suspend');
   // ---------------------------------------tours itineraries management---------------------------------------


   // ---------------------------------------tour attributes management---------------------------------------
   Route::resource('tours-attributes', AdminTourAttributesController::class);
   Route::get('tours-attributes/{id}/suspend', [AdminTourAttributesController::class, 'suspend'])->name('tours-attributes.suspend');
   // ---------------------------------------tour attributes management---------------------------------------

   // ---------------------------------------tour attributes management---------------------------------------
   Route::resource('tours-inclusions', AdminTourInclusionController::class);
   Route::get('tours-inclusions/{id}/suspend', [AdminTourInclusionController::class, 'suspend'])->name('tours-inclusions.suspend');
   // ---------------------------------------tour attributes management---------------------------------------

   // ---------------------------------------tour exclusions management---------------------------------------
   Route::resource('tours-exclusions', AdminTourExclusionController::class);
   Route::get('tours-exclusions/{id}/suspend', [AdminTourExclusionController::class, 'suspend'])->name('tours-exclusions.suspend');
   // ---------------------------------------tour exclusions management---------------------------------------


   // ---------------------------------------tours additionals management---------------------------------------
   Route::resource('tours-additionals', AdminToursAdditionalController::class);
   Route::get('tours-additionals/{id}/suspend', [AdminToursAdditionalController::class, 'suspend'])->name('tours-additionals.suspend');
   // ---------------------------------------tours additionals management---------------------------------------

   // ---------------------------------------tour attributes management---------------------------------------
   Route::resource('additional-items', AdminAdditionalItemController::class);
   Route::get('additional-items/{id}/suspend', [AdminAdditionalItemController::class, 'suspend'])->name('additional-items.suspend');
   // ---------------------------------------tour attributes management---------------------------------------

   // ---------------------------------------tour attributes management---------------------------------------
   Route::resource('tour-reviews', AdminTourReviewController::class);
   Route::get('tour-reviews/{id}/suspend', [AdminTourReviewController::class, 'suspend'])->name('tour-reviews.suspend');
   // ---------------------------------------tour attributes management---------------------------------------

   // ---------------------------------------tour attributes management---------------------------------------
   Route::resource('promotions', AdminPromotionController::class);
   Route::get('promotions/{id}/suspend', [AdminPromotionController::class, 'suspend'])->name('promotions.suspend');
   // ---------------------------------------tour attributes management---------------------------------------



   // ---------------------------------------testimonial management---------------------------------------
   Route::resource('testimonials', AdminTestimonialController::class);
   Route::get('testimonials/{id}/suspend', [AdminTestimonialController::class, 'suspend'])->name('testimonials.suspend');
   Route::delete('testimonials/images/{id}', [AdminTestimonialController::class, 'deleteOtherImage'])->name('testimonials.image.delete');

   // ---------------------------------------testimonial management---------------------------------------

});




// ---------------------------------------Admin---------------------------------------