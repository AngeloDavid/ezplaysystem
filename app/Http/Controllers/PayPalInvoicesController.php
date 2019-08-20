<?php

namespace App\Http\Controllers;

use App\PPInvoice;
use Illuminate\Http\Request;

class PayPalInvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payPalConfig= \Config::get('paypal');
        /*$apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AdTG5HIyXFQMpOtgR-8DEeU8q87le9OohEE2acrzVujJm2NAZ9N5-Q7Jls9OiQOqDBkoT5KSdljJN4B8',     // ClientID
                'EPT-BonuRKBaOxTVeOKjrNc2gEgLgoc0f9cjWwl22cjNYnb3R_CiFQLgFAlyE4jx4MF9rZDq8b1H0eIt'      // ClientSecret
            )
        );*/
    
        //crea el objeto de la factura
        $ppi = new PPInvoice();
        //escoje los datos de conexion
        $cliente_id = $payPalConfig['mode'] == 'sandbox'? $payPalConfig['sandbox']['username']:$payPalConfig['live']['username'] ;
        $password = $payPalConfig['mode'] == 'sandbox'? $payPalConfig['sandbox']['password']:$payPalConfig['live']['password'] ;

        $ppi->setApiContext($cliente_id,$password); 

        //muestra el numero de factura que toca
        //dd($ppi->getNextNumberInvoice());

        //mostrar todas las facturas
        dd($ppi->getInvoices());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PPInvoice  $pPInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(PPInvoice $pPInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PPInvoice  $pPInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(PPInvoice $pPInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PPInvoice  $pPInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PPInvoice $pPInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PPInvoice  $pPInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(PPInvoice $pPInvoice)
    {
        //
    }
}
