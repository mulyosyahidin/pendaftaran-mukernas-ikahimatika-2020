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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::group(['namespace' => 'Api\Himpunan'], function () {
        Route::resource('himpunan/regions', 'RegionController');
        Route::resource('himpunan/universities', 'UniversityController');
        Route::resource('himpunan/organizations', 'OrganizationController');
    });
    
    Route::group(['namespace' => 'Api\Setting'], function () {
        Route::resource('setting/banks', 'BankController');
        Route::resource('setting/contacts', 'ContactController');
    });

    Route::resource('registrants-data', 'Api\RegistrantController');
});

Route::resource('regions-public', 'Api\Accessible\RegionController');
Route::resource('universities-public', 'Api\Accessible\UniversityController');
Route::resource('organizations-public', 'Api\Accessible\OrganizationController');