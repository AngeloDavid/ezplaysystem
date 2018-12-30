<?php

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

Route::get('/', function () {
    $rutes = [
        "Inicio" => "",      
    ];
    $title="Inicio";
    return view('welcome',compact('rutes','title'));
});


Route::get('/Clientes/{id}/delete', 'CustomerController@activar')->where('id','[0-9]+')->name('Clientes.activar');
Route::get('/Facturas/{id}/delete', 'invoiceController@anular')->where('id','[0-9]+')->name('Facturas.anular');
Route::get('/Empresas/{id}/delete', 'CompanyController@activar')->where('id','[0-9]+')->name('Clientes.activar');
Route::resources([
    'Clientes'=> 'CustomerController',
    'Facturas'=> 'InvoiceController',
    'Empresas'=> 'CompanyController'
]);