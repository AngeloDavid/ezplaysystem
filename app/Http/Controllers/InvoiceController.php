<?php

namespace App\Http\Controllers;

use App\invoice;
use App\Costumer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    var $title = "Factura";
    var $estados = [
        "AL"=>"Alabama ",
        "AK"=>"Alaska ",
        "AZ"=>"Arizona ",
        "AR"=>"Arkansas ",
        "CA"=>"California ",
        "CO"=>"Colorado ",
        "CT"=>"Connecticut ",
        "DE"=>"Delaware ",
        "DC"=>"Distrito de Columbia ",
        "FL"=>"Florida ",
        "GA"=>"Georgia ",
        "HI"=>"Hawaii ",
        "ID"=>"Idaho ",
        "IL"=>"Illinois ",
        "IN"=>"Indiana ",
        "IA"=>"Iowa ",
        "KS"=>"Kansas ",
        "KY"=>"Kentucky ",
        "LA"=>"Louisiana ",
        "ME"=>"Maine ",
        "MD"=>"Maryland ",
        "MA"=>"Massachusetts ",
        "MI"=>"Michigan ",
        "MN"=>"Minnesota ",
        "MS"=>"Mississippi ",
        "MO"=>"Missouri ",
        "MT"=>"Montana ",
        "NE"=>"Nebraska ",
        "NV"=>"Nevada ",
        "NH"=>"New Hampshire ",
        "NJ"=>"New Jersey ",
        "NM"=>"New Mexico ",
        "NY"=>"New York ",
        "NC"=>"North Carolina ",
        "ND"=>"North Dakota ",
        "OH"=>"Ohio ",
        "OK"=>"Oklahoma ",
        "OR"=>"Oregon ",
        "PA"=>"Pennsylvania ",
        "RI"=>"Rhode Island ",
        "SC"=>"South Carolina ",
        "SD"=>"South Dakota ",
        "TN"=>"Tennessee ",
        "TX"=>"Texas ",
        "UT"=>"Utah ",
        "VT"=>"Vermont ",
        "VA"=>"Virginia ",
        "WA"=>"Washington ",
        "WV"=>"West Virginia ",
        "WI"=>"Wisconsin ",
        "WY"=>"Wyoming "
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facturas = DB::table('invoice')->latest('created_at')->paginate(10);
        $rutes = [
            "Inicio" => "/",   
            "Facturas" => ""
        ];
        $title=$this->title."ción";
        return view('invoice.index',compact('title','rutes','facturas'));
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

        $invoce= new invoice();
        $costumer = new Costumer ();
        $customers = DB::table('costumer')->where('status','=',1)->latest('created_at')->paginate(10);
        $title="Nueva ".$this->title;
        $estados = $this->estados;
        $urlForm ='Facturas';
        $isnew= true;
        return view('invoice.new',compact('title','rutes','customers','estados','costumer','invoce','urlForm','isnew'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
      
        
        $data = request()->all();
       
        if(isset($data['terminos']) ){
         //  dump($data);
            $id_customer = $data['id_customer'];
            if (is_null($data['id_customer'])){
              //  dd($data['id_customer']);
                $customer_new= Costumer::create([
                    'ruc'=>$data['ruc'], 
                    'name'=>$data['name'],
                    'email'=>$data['email'],
                    'address'=>$data['address'],
                    'city'=>$data['city'],
                    'state'=>$data['state'],
                    'country'=>$data['country'],
                    'postal_code'=>$data['postal_code'],
                    'type'=>'Juridica',
                    'origin'=>'Extranjero',
                    'status'=>1
                ]);   
                $id_customer = $customer_new->id;
            }else {
                $id_customer = $data['id_customer'];
            }
            // dd($id_customer);
            invoice::create([
                'code'=>$data['code'],
                'desp'=>$data['desp'],
                'type'=>'FACT',
                'IVA'=> $data['IVA'],
                'wayToPay'=>$data['wayToPay'],
                'amount'=>$data['amount'],
                'ivaincluded'=>$data['ivaincluded']=='on'?true:false,
                'status'=>1,
                'id_customer'=>$id_customer
            ]); 
        }
         
         return redirect()->route('Facturas.index');
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
