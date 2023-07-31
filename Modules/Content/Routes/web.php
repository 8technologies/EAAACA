<?php

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

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'activity'])->prefix('dashboard/content')->name('dashboard.')->group(function() {
	Route::get('/', 'ContentController@index')->name('content');
    // ContentPage
    Route::resource('pages', 'ContentPageController');
    Route::post('pages/{id}/addcontentsection', 'ContentPageController@addContentSection')->name('pages.addcontentsection');
    Route::post('pages/{id}/updaterows', 'ContentPageController@updateRows')->name('pages.updaterows');

    // ContentService
    Route::resource('services', 'ContentServiceController');
    Route::post('services/{id}/addcontentsection', 'ContentServiceController@addContentSection')->name('services.addcontentsection');
    Route::post('services/{id}/updaterows', 'ContentServiceController@updateRows')->name('services.updaterows');
    
    // ContentOurWork
    Route::resource('our_work', 'ContentOurWorkController');
    Route::post('our_work/{id}/addcontentsection', 'ContentOurWorkController@addContentSection')->name('our_work.addcontentsection');
    Route::post('our_work/{id}/updaterows', 'ContentOurWorkController@updateRows')->name('our_work.updaterows');

    Route::resource('news', 'ContentNewsController');
    Route::resource('events', 'ContentEventController');
    Route::resource('blog-posts', 'ContentBlogPostController');
    Route::resource('publications', 'ContentPublicationController');
    Route::resource('gallery', 'ContentGalleryController');
    Route::resource('featured', 'ContentFeaturedController');
    Route::resource('testimonies', 'ContentTestimonyController');
});

Route::middleware(['activity'])->group(function() {

    // Front-End Routes
    Route::get('/', 'ContentController@showPage')->name('front')->defaults('id', '1');
    Route::get('/home', 'ContentController@showPage')->name('home')->defaults('id', '1');
    Route::get('/about-us', 'ContentController@showPage')->name('about-us')->defaults('id', '2');
    Route::get('/contact', 'ContentController@showPage')->name('contact')->defaults('id', '3');
    Route::get('/terms-of-service', 'ContentController@showPage')->name('terms')->defaults('id', '4');
    Route::get('/privacy-policy', 'ContentController@showPage')->name('policy')->defaults('id', '5');
    // Route::get('/services', 'ContentController@showPage')->name('services')->defaults('id', '4');

    Route::get('news', 'ContentController@news')->name('news');
    Route::get('news/{slug}', 'ContentController@showNews')->name('news.show');

    Route::get('services', 'ContentController@services')->name('services');
    Route::get('services/{slug}', 'ContentController@showService')->name('service.show');

    Route::get('our_work', 'ContentController@ourWork')->name('our_work');
    Route::get('our_work/{slug}', 'ContentController@showOurWork')->name('our_work.show');

    Route::get('blog', 'ContentController@blog')->name('blog');
    Route::get('blog/{slug}', 'ContentController@showBlog')->name('blog.show');
    Route::any('blog/{slug}', 'ContentController@showBlog')->where('slug', '.*');

    Route::get('events', 'ContentController@events')->name('events');
    Route::get('events/{slug}', 'ContentController@showEvent')->name('event.show');

    Route::get('publications', 'ContentController@publications')->name('publications');
    Route::get('publications/{slug}', 'ContentController@showPublication')->name('publication.show');

    Route::get('gallery', 'ContentController@gallery')->name('gallery');
    Route::get('gallery/{slug}', 'ContentController@showGallery')->name('gallery.show');

    // Route::get('featured', 'ContentController@featured')->name('featured');
    Route::get('featured/{slug}', 'ContentController@showFeatured')->name('featured.show');

    Route::get('testimonies', 'ContentController@testimonies')->name('testimonies');
    Route::get('testimonies/{slug}', 'ContentController@showTestimony')->name('testimonies.show');

    // // Wildcard routes
    // Route::any('{slug}', '\Modules\Content\Http\Controllers\ContentController@showPage')
    //     ->where('slug', '^((?!stream|messages|dashboard|api|account|user|taxonomy).)*')
    //     ->name('page');
});