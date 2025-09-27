<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContentController;

Route::GET('/', [MainController::class, 'Index'])->name('Index');
Route::GET('/contact-us', [GeneralController::class, 'Contact']);
Route::POST('/contact-us', [GeneralController::class, 'SubmitContact']);
Route::GET('/about-us', [GeneralController::class, 'About']);
Route::GET('/privacy', [GeneralController::class, 'Privacy']);
//Route::GET('/copyright', [GeneralController::class, 'Copyright']);
Route::GET('/privacy-hsr', [GeneralController::class, 'PrivacyHSR']);
Route::GET('/privacy-policy', [GeneralController::class, 'Privacy']);
Route::GET('/terms', [GeneralController::class, 'Terms']);
Route::GET('/search', [MainController::class, 'Search']);
Route::GET('/character', [CharacterController::class, 'IndexCharacter'])->name('Character');
Route::GET('/series', [SeriesController::class, 'IndexSeries'])->name('Series');
//Route::GET('/terms2', [GeneralController::class, 'Terms2']);

Route::GET('/blog', [BlogController::class, 'IndexBlog'])->name('Blog');
Route::GET('/blog/add-post', [ContentController::class, 'ContentEditor']);
Route::POST('/blog/add-post', [ContentController::class, 'ContentProccess']);
Route::POST('/blog/upload-image', [ContentController::class, 'UploadImage']);

Route::GET('/tag', [TagController::class, 'IndexTag'])->name('Tag');

Route::GET('/signup', [UserController::class, 'SignupView']);
Route::POST('/signup', [UserController::class, 'SignupProccess']);
Route::GET('/signin', [UserController::class, 'SigninView']);
Route::POST('/signin', [UserController::class, 'SigninProccess']);
Route::GET('/signout', [UserController::class, 'SignoutProccess']);
Route::GET('/forgot-password', [UserController::class, 'ForgotView']);
Route::POST('/forgot-password', [UserController::class, 'ForgotProccess']);
Route::GET('/resend-verification', [UserController::class, 'SendVerification']);
Route::GET('/reset-password', [UserController::class, 'ResetView']);
Route::POST('/reset-password', [UserController::class, 'ResetProccess']);
Route::GET('/verify', [UserController::class, 'VerifyProccess']);

Route::GET('/profile', [UserController::class, 'MyProfile']);
Route::POST('/profile', [UserController::class, 'UpdateProfile']);

Route::GET('/sitemap.xml', [SitemapController::class, 'IndexSitemap']);
Route::GET('/sitemap-post.xml', [SitemapController::class, 'IndexPost']);
Route::GET('/sitemap-series.xml', [SitemapController::class, 'IndexSeries']);
Route::GET('/sitemap-character.xml', [SitemapController::class, 'IndexCharacter']);
Route::GET('/sitemap-blog.xml', [SitemapController::class, 'IndexBlog']);

Route::GET('/sitemap-post-{PostIndex}.xml', [SitemapController::class, 'SitemapPost']);
Route::GET('/sitemap-series-{SeriesIndex}.xml', [SitemapController::class, 'SitemapSeries']);
Route::GET('/sitemap-character-{CharacterIndex}.xml', [SitemapController::class, 'SitemapCharacter']);
Route::GET('/sitemap-blog-{BlogIndex}.xml', [SitemapController::class, 'SitemapBlog']);

Route::GET('/tag/{TagSlug}', [TagController::class, 'TagWallpaper']);
Route::GET('/blog/{BlogSlug}', [BlogController::class, 'ViewPost']);
Route::GET('/profile/{Username}', [UserController::class, 'UserProfile']);

Route::GET('/{WallpaperID}', [MainController::class, 'ViewImage']);
Route::POST('/{WallpaperID}', [MainController::class, 'DownloadImage']);

Route::GET('/{SeriesSlug}', [SeriesController::class, 'SeriesWallpaper']);
Route::GET('/{SeriesSlug}/character', [SeriesController::class, 'SeriesCharacter']);
Route::GET('/{SeriesSlug}/{CharacterSlug}', [CharacterController::class, 'CharacterWallpaper']);