<?php

/*
|--------------------------------------------------------------------------
| frontend Routes
|--------------------------------------------------------------------------
|
*/

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

require_once __DIR__ . '/../app/Modules/Routes/FrontendRoutes.php';

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

require_once __DIR__ . '/../app/Modules/Routes/BackendRoutes.php';

/*
|--------------------------------------------------------------------------
| Test Routes
|--------------------------------------------------------------------------
|
*/

require_once __DIR__ . '/test.php';
/*
|--------------------------------------------------------------------------
| Test Routes
|--------------------------------------------------------------------------
|
*/

Route::group([
    'prefix' => '',
    'namespace' => 'App\Http\Controllers',
], function () {
    // Route::get('/', 'FrontendController\HomeController@index')->name('home');
    // Route::get('/about', 'FrontendController\AboutController@index')->name('about');

    // Route::get('/properties', 'FrontendController\PropertiesController@index')->name('properties');
    // Route::get('/properties/categories', 'FrontendController\PropertiesController@categories')->name('properties.categories');
    // Route::get('/properties/category-wise/{category}', 'FrontendController\PropertiesController@category_wise')->name('properties.category_wise');

    // Route::get('/properties/luxury', 'FrontendController\PropertiesController@luxury')->name('properties.luxury');
    // Route::get('/properties/comercial', 'FrontendController\PropertiesController@comercial')->name('properties.comercial');
    // Route::get('/properties/classic', 'FrontendController\PropertiesController@classic')->name('properties.classic');
    // Route::get('/properties/wellness', 'FrontendController\PropertiesController@wellness')->name('properties.wellness');
    // Route::get('/properties/onging', 'FrontendController\PropertiesController@ongoing')->name('properties.ongoing');
    // Route::get('/properties/upcoming', 'FrontendController\PropertiesController@upcoming')->name('properties.upcoming');
    // Route::get('/properties/completed', 'FrontendController\PropertiesController@completed')->name('properties.completed');
    // Route::get('/properties/details/{id}', 'FrontendController\PropertiesController@details')->name('properties_details');
    // Route::post('/property-customer-review', 'FrontendController\PropertiesController@property_customer_review')->name('property_customer_review');

    // Route::get('/gallery', 'FrontendController\GalleryController@index')->name('gallery');
    // Route::get('/gallery/image', 'FrontendController\GalleryController@image')->name('gallery.image');
    // Route::get('/gallery/video', 'FrontendController\GalleryController@video')->name('gallery.video');

    // Route::get('/news', 'FrontendController\NewsController@index')->name('news');
    // Route::get('/news/details/{slug}', 'FrontendController\NewsController@news_details')->name('news_details');
    // Route::get('/news/category/{slug}', 'FrontendController\NewsController@news_category')->name('news_category');
    // Route::get('/ajax/blog/search', 'FrontendController\NewsController@ajaxSearch')->name('ajax.blog.search');
    // Route::post('/blog-comment', 'FrontendController\NewsController@blog_comment')->name('blog_comment');
    // Route::get('/blog/search', 'FrontendController\NewsController@blog_search')->name('blog.search');

    // Route::get('/contact', 'FrontendController\ContactController@index')->name('contact');
    // Route::post('/contact', 'FrontendController\ContactController@store')->name('contact.store');
    // Route::get('/pages/{perma_link}', 'FrontendController\CustomPageController@index')->name('custom.index');

    // AJAX handler used by frontend theme scripts
    Route::post('/ajax-handler', function (Request $request) {
        // minimal JSON response — replace with real logic or controller as needed
        return response()->json([
            'success' => true,
            'message' => 'AJAX handler reached.',
        ]);
    })->name('ajax.handler');
});
