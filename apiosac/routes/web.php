<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
    // return str_random(32);
    
});

$router->get('/service', 'ServiceController@data');
$router->post('/transaction', 'TransactionController@post');
$router->get('/transaction/show', 'TransactionController@getAllTransactions');
$router->get('/generals', 'GeneralsController@data');
$router->get('/cabang', 'CabangController@getData');

$router->get('/pelanggan', 'PelangganLoginController@login');
$router->post('/pelanggan/register', 'PelangganLoginController@register');
$router->put('/pelanggan/update/{id}', 'PelangganLoginController@update');

$router->get('/cabang/masuk', 'CabangController@getDataMasuk');
$router->get('/report', 'ReportController@data');

$router->group(['prefix' => 'merek'], function () use ($router) {
    $router->get('/', 'MerekController@data');
});
$router->group(['prefix' => 'jasa'], function () use ($router) {
    $router->get('/', 'JasaController@data');
});
$router->group(['prefix' => 'tipe'], function () use ($router) {
    $router->get('/', 'TipeController@data');
});
$router->group(['prefix' => 'transaksi'], function () use ($router) {
    $router->get('/', 'TransaksiController@data');
    $router->post('/', 'TransaksiController@simpan');
});