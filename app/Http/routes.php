<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Intervention\Image\ImageManager;
use Intervention\Image\Response;

Route::get('/test', function () {
    return view('test.test');
});

Route::group([], function () {
    Route::group(['middleware' => 'auth'], function () {

        Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

        Route::resource('recipes', RecipeController::class);
        Route::resource('ingredients', IngredientController::class);
        Route::resource('overheads/costs', OverheadCostController::class);
        Route::resource('overhead_groups', OverheadGroupController::class);
        Route::resource('overheads', OverheadController::class);

        Route::get('products/prices', ['as' => 'products.prices.index', 'uses' => 'ProductPriceController@index']);
        Route::get('products/prices/show', ['as' => 'products.prices.show', 'uses' => 'ProductPriceController@show']);
        Route::get('products/prices/create', ['as' => 'products.prices.create', 'uses' => 'ProductPriceController@create']);
        Route::post('products/prices', ['as' => 'products.prices.store', 'uses' => 'ProductPriceController@store']);

        Route::resource('products', ProductController::class);
        Route::resource('sales', SalesDataController::class);

        Route::get('reports', ['as' => 'reports', 'uses' => 'ReportsController@index']);
        Route::get('reports/overview', ['as' => 'reports.overview', 'uses' => 'ReportsController@getOverview']);
        Route::get('reports/breakdown/groups',
            ['as' => 'reports.groups.index', 'uses' => 'ReportsController@getGroupList']);
        Route::get('reports/breakdown/groups/{id}',
            ['as' => 'reports.groups.show', 'uses' => 'ReportsController@getGroup']);
        Route::get('reports/breakdown/subgroups',
            ['as' => 'reports.subgroups.index', 'uses' => 'ReportsController@getSubgroupList']);
        Route::get('reports/breakdown/subgroups/{id}',
            ['as' => 'reports.subgroups.show', 'uses' => 'ReportsController@getSubgroup']);
        Route::get('reports/breakdown/products',
            ['as' => 'reports.products.index', 'uses' => 'ReportsController@getProductsList']);
        Route::get('reports/breakdown/products/{id}',
            ['as' => 'reports.products.show', 'uses' => 'ReportsController@getProduct']);

        Route::get('reports/export/breakdown/products',
            ['as' => 'reports.products.excel', 'uses' => 'ReportsController@exportProducts']);

        Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    });
    Route::get('auth/login', ['as' => 'auth.login', 'uses' => 'AuthController@getLogin']);
    Route::post('auth/login', ['uses' => 'AuthController@postLogin']);
    Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'AuthController@getLogout']);
});

