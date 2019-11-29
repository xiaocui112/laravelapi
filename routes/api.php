<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->namespace('Api')->middleware('throttle:' . config('api.rate_limits.sign'))->name('api.v1.')->group(function () {
    Route::post('verificationCodes', 'VerificationCodesController@store')->name('verificationCode.store');
    Route::post('users', 'UsersController@store')->name('users.store');
    Route::post('captchas', 'CaptchasController@store')
        ->name('captchas.store');
    Route::post('socials/{social_type}/authorizations', 'AuthorizationsController@socialStore')->where('social_type', 'weixin')->name('socials.authorizations.store');
    Route::post('authorizations', 'AuthorizationsController@store')->name('api.authorjizations.store');
    Route::put('authorizations/current', 'AuthorizationsController@update')->name('authorizations.update');
    Route::delete('authorizations/current', 'AuthorizationsController@destroy')->name('authorizations.destroy');
});
