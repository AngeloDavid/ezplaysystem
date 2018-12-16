<?php

namespace App\Http\Controllers;

use App\invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    var $title = "Factura";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rutes = [
            "Inicio" => "/",   
            "Facturas" => ""
        ];
        $title=$this->title."ción";
        return view('invoice.index',compact('title','rutes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rutes = [
            "Inicio" => "/",   
            "Facturas" => "/Facturas",
            "Nuevo"=>""
        ];
        $title="Nueva ".$this->title;
        return view('invoice.new',compact('title','rutes'));
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
     * @param  \App\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoice $invoice)
    {
        //
    }
}
