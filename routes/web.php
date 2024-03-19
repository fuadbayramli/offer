<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', 'MainController@mainOffers')->name('main.page');

Route::get('/user','UserController@all');
Route::get('/user/profile/{id}','UserController@show')
    ->middleware(['access.denied'])
    ->where('id', '[0-9]+')
    ->name('user.profile');
Route::post('/user', 'UserController@store');
Route::put('/user/{id}', 'UserController@update')
    ->where('id', '[0-9]+')
    ->middleware(['access.denied']);

// Offer Routes
Route::get('/create/offer', 'OfferController@create')
    ->middleware('custom.auth')
    ->name('make.offer');

Route::post('offer', 'OfferController@store');
Route::post('addImage', 'OfferController@uploadImage');



Route::get('/my/offers','UserController@getUserOffers')
    ->middleware('custom.auth')
    ->name('my.offers');

Route::get('/offer/info/{id}','OfferController@show')
    ->where('id', '[0-9]+')
    ->name('offer.info');

Route::get('/offer/edit/{id}','OfferController@edit')
    ->where('id', '[0-9]+')
    ->name('offer.edit');

Route::post('/offer/update/{id}', 'OfferController@update')
    ->where('id', '[0-9]+')
    ->middleware(['custom.auth','access.denied']);

Route::post('/offer/like', 'OfferController@offerLike');
Route::post('/result/like', 'ResultController@resultLike');

Route::get('/offers', 'OfferController@all')->name('all.offers');

Route::get('/offers/search', 'OfferController@offerSearch')->name('offers.search');

// Result Routes
Route::get('/results', 'ResultController@all')->name('all.results');
Route::get('/results/search', 'ResultController@resultSearch')->name('results.search');

Route::get('/my/results','UserController@getUserResults')
    ->middleware('custom.auth')
    ->name('my.results');

Route::get('/result/info/{id}','ResultController@show')
    ->where('id', '[0-9]+')
    ->name('result.info');


// faq routes
//Route::get('/faqs', 'FaqController@all')->name('questions');

// auth routes
Route::put('change/user/password', 'AuthController@changePassword')->middleware('custom.auth');
Route::post('/login', 'AuthController@auth');
Route::get('/logout','AuthController@logout')->name('user.logout');

//about Route
Route::get('/about', 'AboutController@aboutUs')->name('about');

// Password reset link request routes...
Route::post('password/email', 'ForgotPasswordController@forgot');

// Password reset routes...
Route::get('password/reset', 'ForgotPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'ForgotPasswordController@reset');

// Admin routes
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::delete('/offer/image/{id}',['uses' => 'Admin\Voyager\OfferImageController@destroy',  'as' => 'voyager.offer.image.destroy']);
    Route::delete('/offer/video/{id}',['uses' => 'Admin\Voyager\OfferVideoController@destroy',  'as' => 'voyager.offer.video.destroy']);
//    Route::get('/ExportCommandes','ExportController@getExport');
});

Route::group(['prefix' => 'admin','as' => 'voyager.', 'middleware' => 'admin.user'], function()
{
    Route::get('/ExportCommandes','Admin\Voyager\ExcelController@exportOffer')->name('export.offer');
});
