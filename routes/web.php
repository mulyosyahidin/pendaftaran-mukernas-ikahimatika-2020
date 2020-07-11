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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();
Route::post('register', 'Auth\RegisterController@store')->name('register.do');
Route::post('login', 'AuthController@login')->name('login');

Route::group(['middleware' => ['role:admin']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', 'Admin\AdminController@index')->name('admin.home');

        Route::prefix('settings')->group(function () {
            Route::get('/', 'Admin\SettingController@index')->name('admin.settings');
            Route::get('/profile', 'Admin\SettingController@profile')->name('admin.settings.profile');

            Route::get('/banks', 'Admin\SettingController@banks')->name('admin.settings.banks');
            Route::get('/contacts', 'Admin\SettingController@contacts')->name('admin.settings.contacts');

            Route::post('/store', 'Admin\SettingController@store')->name('admin.settings.store');
        });

        Route::prefix('himpunan')->group(function () {
            Route::get('/', 'Admin\Himpunan\HimpunanController@index')->name('admin.himpunan');
            Route::get('/create', 'Admin\Himpunan\HimpunanController@create')->name('admin.himpunan.create');
            Route::post('/store', 'Admin\Himpunan\HimpunanController@store')->name('admin.himpunan.store');
            Route::get('/region', 'Admin\Himpunan\RegionController@index')->name('admin.region');

            Route::get('/university', 'Admin\Himpunan\UniversityController@index')->name('admin.university');
        });

        Route::prefix('registrant')->group(function () {
            Route::get('/', 'Admin\RegistrantController@index')->name('admin.reg.all');
            Route::get('/status|{status}', 'Admin\RegistrantController@display')->name('admin.reg.display');

            Route::get('/export', 'Admin\RegistrantController@export')->name('admin.reg.export');
            Route::post('/export', 'Admin\RegistrantController@export_data')->name('admin.reg.export-data');

            Route::get('/{id}', 'Admin\RegistrantController@show')->name('admin.reg.show');
            Route::put('/{id}/accept', 'Admin\RegistrantController@accept')->name('admin.reg.accept');
            Route::put('/{id}/decline', 'Admin\RegistrantController@decline')->name('admin.reg.decline');
            Route::put('/{id}/mark-as-payed', 'Admin\RegistrantController@payed')->name('admin.reg.mark-as-payed');

            Route::get('/{registrant}/edit', 'Admin\RegistrantController@edit')->name('admin.reg.edit');
            Route::put('/{registrant}/edit', 'Admin\RegistrantController@update')->name('admin.reg.update');
            Route::delete('/{id}/delete', 'Admin\RegistrantController@destroy')->name('admin.reg.destroy');
        });
    });
});

//pendaftar
Route::group(['middleware' => ['role:registrant']], function () {
    Route::get('/home', 'Registrant\RegistrantController@index')->name('reg.home');

    Route::get('/pendaftaran/data', 'Registrant\RegistrantController@data')->name('reg.data');
    Route::get('/pendaftaran/status', 'Registrant\RegistrantController@status')->name('reg.status');

    Route::prefix('help')->group(function() {
        Route::get('/', 'Registrant\HelpController@index')->name('reg.help');
        Route::get('/contacts', 'Registrant\HelpController@contacts')->name('reg.help.contacts');
        Route::get('/banks', 'Registrant\HelpController@banks')->name('reg.help.banks');
    });

    Route::get('/profile', 'Registrant\ProfileController@index')->name('reg.account');
    Route::post('/profile', 'Registrant\ProfileController@store')->name('reg.account.store');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/check-role', function () {
        $roles = Auth::user()->getRoleNames();

        if ($roles[0] == 'registrant') {
            return redirect()
                ->to(route('reg.home'));
        }
        else if ($roles[0] == 'admin') {
            return redirect()
                ->to(route('admin.home'));
        }
        else {
            return redirect()
                ->to(route('home'));
        }
    });
});
