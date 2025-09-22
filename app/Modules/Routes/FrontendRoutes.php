<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Controllers\Frontend\FrontendController;
use App\Modules\Controllers\Frontend\Auth\AuthController;



Route::get('/', [FrontendController::class, 'HomePage'])->name('HomePage');
Route::get('/about-us', [FrontendController::class, 'AboutUsPage'])->name('AboutUsPage');
Route::get('/portfolio', [FrontendController::class, 'PortfolioPage'])->name('PortfolioPage');
Route::get('/portfolio/property-details', [FrontendController::class, 'PortfolioPropertyPage'])->name('PortfolioPropertyPage');
Route::get('/project', [FrontendController::class, 'ProjectPage'])->name('ProjectPage');
Route::get('/team', [FrontendController::class, 'TeamPage'])->name('TeamPage');
Route::get('/service', [FrontendController::class, 'ServicePage'])->name('ServicePage');
Route::get('/service/details', [FrontendController::class, 'ServiceDetailsPage'])->name('ServiceDetailsPage');
Route::get('/gallery', [FrontendController::class, 'GalleryPage'])->name('GalleryPage');
Route::get('/gallery/images', [FrontendController::class, 'GalleryImagesPage'])->name('GalleryImagesPage');
Route::get('/gallery/videos', [FrontendController::class, 'GalleryVideosPage'])->name('GalleryVideosPage');
Route::get('/blog', [FrontendController::class, 'BlogPage'])->name('BlogPage');
Route::get('/blog/details', [FrontendController::class, 'BlogDetailsPage'])->name('BlogDetailsPage');
Route::get('/contact', [FrontendController::class, 'ContactPage'])->name('ContactPage');

Route::get('/pages/{permalink}', [FrontendController::class, 'pages'])->name('pages');


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'LoginPage'])->name('LoginPage');
Route::get('/register', [AuthController::class, 'RegisterPage'])->name('RegisterPage');
Route::get('/forgot-password', [AuthController::class, 'ForgotPassword'])->name('ForgotPassword');
