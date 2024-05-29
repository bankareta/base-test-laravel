<?php
use Illuminate\Support\Facades\Route;
use Mews\Captcha\Facades\Captcha;
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
//use \Excel;

Route::get('/', function () {
    return redirect('login');
});

Route::get('captcha/{config?}', function ($config = 'default') {
    return Captcha::create($config);
});

Route::get('/reload-captcha', function () {
    return response()->json(['captcha'=> captcha_img('flat')]);
});

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'Auth'], function(){
        Route::get('profile/getsign/{id}', 'ProfileController@getsign');
        Route::post('profile/sign-upload', 'ProfileController@signUpload');
        Route::post('profile/pic-upload', 'ProfileController@picUpload');
        Route::resource('profile', 'ProfileController');
    });

    Route::group(['namespace' => 'Picture'], function(){
        Route::post('picture/file-upload', 'PictureController@fileUpload');
        Route::post('picture/bulk-unlink', 'PictureController@bulkUnlink');
        Route::post('picture/unlink', 'PictureController@unlink');
        Route::resource('picture', 'PictureController');
    });

    Route::group(['prefix' => 'konfigurasi', 'namespace' => 'Konfigurasi'], function(){
        Route::post('users/grid', 'UsersController@grid');
        Route::resource('users', 'UsersController');

        Route::put('roles/{id}/grant', 'RolesController@grant');
        Route::post('roles/grid', 'RolesController@grid');
        Route::resource('roles', 'RolesController');
	});
});

Route::get('/home', 'Dashboard\DashboardController@index');
Route::get('/dashboard', 'Dashboard\DashboardController@index');
Route::get('/welcome', 'Dashboard\DashboardController@welcome');

