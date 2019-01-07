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

Route::get('/login', 'CompanyController@home')->name('homeLogin');
Route::post('/validate', 'CompanyController@login');
Route::get('/Perfil', 'CompanyController@profile')->name('Empresas.profile');
Route::get('/logout', function(){
	\Session::forget('user');
    return redirect('/login');
});


Route::get('/Clientes/{id}/delete', 'CustomerController@activar')->where('id','[0-9]+')->name('Clientes.activar');
Route::get('/Facturas/{id}/delete', 'invoiceController@anular')->where('id','[0-9]+')->name('Facturas.anular');
Route::get('/Facturas/{id}/status', 'invoiceController@changestatus')->where('id','[0-9]+')->name('Facturas.changestatus');
Route::get('/Empresas/{id}/delete', 'CompanyController@activar')->where('id','[0-9]+')->name('Clientes.activar');
Route::get('/Empresas/{id}/resetarPWD', 'CompanyController@resetarPWD')->where('id','[0-9]+')->name('Empresas.resetearPwd');
Route::get('/TodasFacturas', 'invoiceController@allinvoices')->where('id','[0-9]+')->name('Empresas.allinvoices');

Route::resources([
    'Clientes'=> 'CustomerController',
    'Facturas'=> 'InvoiceController',
    'Empresas'=> 'CompanyController'
]);