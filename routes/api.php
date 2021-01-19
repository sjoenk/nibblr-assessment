<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Dinner;

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

Route::middleware(['json.response'])->group(function () {
    Route::post('/register', 'Api\AuthController@register');
    Route::post('/login', 'Api\AuthController@login');

    Route::middleware(['auth:api'])->group(function () {
        Route::get('/profile', 'Api\UserController@show');
        Route::put('/profile', 'Api\UserController@update');

        Route::apiResource('dinners', 'Api\DinnerController');
        Route::post('/dinners/{dinner}/enrollment', 'Api\DinnerEnrollmentController@registerEnrollment');
        Route::delete('/dinners/{dinner}/enrollment', 'Api\DinnerEnrollmentController@cancelEnrollment');
    });
});
