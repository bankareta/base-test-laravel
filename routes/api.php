<?php

use Illuminate\Http\Request;

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

Route::group(['namespace' => 'API'], function(){
    Route::post('login', 'UserController@login');
    Route::post('refresh', 'UserController@refresh');

    Route::middleware(['auth:api-jwt'])->group(function () {
        // auth('api')->factory()->setTTL(60);
        Route::get('me', 'UserController@me');
        Route::get('refresh-token', 'UserController@refresh');
        Route::post('device', 'UserController@storeDevice');
        Route::post('logout', 'UserController@logout');

        Route::resource('/dashboard', 'DashboardController');
        Route::resource('/bulletin', 'BulletinController');
        Route::resource('/policy', 'PolicyController');
        Route::resource('/company', 'CompanyController');

        Route::get('/hnmr/nomor-site', 'HnmrController@getNumberSite');
        Route::get('/hnmr/nomor', 'HnmrController@getNumber');
        Route::post('/hnmr/send-monitoring', 'HnmrController@sendAction');

        Route::get('/hnmr-monitoring', 'HnmrController@getMonitoring');
        Route::post('/hnmr-monitoring', 'HnmrController@saveMonitor');
        
        Route::get('/hnmr-action', 'HnmrController@getact');
        Route::post('/hnmr-action', 'HnmrController@saveact');
        
        Route::resource('/hnmr', 'HnmrController');

        Route::get('/accident/nomor-site', 'AccidentController@getNumberSite');
        Route::get('/accident/nomor', 'AccidentController@getNumber');
        Route::get('/accident/send-action', 'AccidentController@sendAction');
        Route::resource('/accident', 'AccidentController');

        Route::resource('/accident-action', 'AccidentActionController');

        Route::resource('/accident-approve', 'AccidentApproveController');

        Route::resource('/accident-monitoring', 'AccidentMonitoringController');
        Route::get('/accident-monitoring/print/{id}', 'AccidentMonitoringController@printPdf');

        Route::resource('/fauna', 'FaunaController');

        Route::resource('/pob-screening', 'PobController');
        
        Route::resource('/observation-card', 'ObservationCardController');

        Route::resource('/pre-trip', 'PreTripController');


        Route::group(['namespace' => 'Master'], function(){
            Route::resource('/department', 'DepartmentController');
            Route::resource('/supervisor', 'SupervisorController');
            Route::get('/supervisor-accident', 'SupervisorController@getAccident');
            
            Route::resource('/pob-reason', 'PobReasonController');
            Route::resource('/vaccine-status', 'VaccineStatusController');
            Route::resource('/location', 'LocationController');
            Route::resource('/category-obs', 'ObservationCategoryController');
            Route::resource('/energy-source', 'EnergySourceController');
            Route::resource('/criteria-pre-trip', 'PreTripCriteriaController');
        });
        
        Route::group(['namespace' => 'API\Type'], function(){
            Route::resource('/type-policy', 'TypePolicyController');
            Route::resource('/type-bulletin', 'TypeBulletinController');
            Route::resource('/type-accident', 'TypeAccidentController');
        });
        
        Route::group(['prefix' => 'slider', 'namespace' => 'API\Slider'], function(){
            Route::get('/{id}', 'SliderController@show');
            Route::resource('/', 'SliderController');
        });
    });
});