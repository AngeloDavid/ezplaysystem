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
Route::get('/CXC/{id}/', 'CustomerController@getInvoices')->where('id','[0-9]+')->name('Clientes.facturas');
Route::get('/Facturas/{id}/delete', 'InvoiceController@anular')->where('id','[0-9]+')->name('Facturas.anular');
Route::get('/Facturas/{id}/status', 'InvoiceController@changestatus')->where('id','[0-9]+')->name('Facturas.changestatus');
Route::get('/Facturas/{id}/send','InvoiceController@sendPayPal')->where('id','[0-9]+')->name('Facturas.send');
Route::get('/Empresas/{id}/delete', 'CompanyController@activar')->where('id','[0-9]+')->name('Clientes.activar');
Route::get('/Empresas/{id}/resetarPWD', 'CompanyController@resetarPWD')->where('id','[0-9]+')->name('Empresas.resetearPwd');
Route::get('/TodasFacturas', 'InvoiceController@allinvoices')->name('Empresas.allinvoices');
Route::get('/TodasFacturas/{id}', 'InvoiceController@allinvoices')->where('id','[0-9]+');
Route::get('/ExportFacturas', 'InvoiceController@exportEXCELINVOICES')->name('Empresas.export');
Route::get('/Facturas/buscar_admin/{code}/{cli}/{desc}/{emp}/{fecha}/{amount}/{status}','InvoiceController@searchinvoiceadmin')->name('Empresas.searchadmin');
Route::get('/Facturas/buscar/{code}/{cli}/{desc}/{fecha}/{amount}/{status}','InvoiceController@searchinvoice')->name('Empresas.search');
Route::get('/Clientes/buscar/{ruc}/{name}/{date}/{place}/{status}','CustomerController@searchCustomer')->name('Clientes.search');

Route::resources([
    'Clientes'=> 'CustomerController',
    'Facturas'=> 'InvoiceController',
    'Empresas'=> 'CompanyController',
    'paypal'=>'PayPalInvoicesController'
]);


Route::get('/mail', function ()
{
    return view('e-mails.invoicesNewadmin');
});

Route::post('/pago', 'SuscripcionController@pago');
