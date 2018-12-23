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
        $invoices = DB::table('invoice')                        
                        ->leftjoin('costumer','invoice.id_customer','=','costumer.id')
                        ->select('invoice.id','invoice.code','invoice.date','invoice.desp','invoice.created_at','invoice.amount','invoice.file','invoice.status','costumer.id as id_customer','costumer.name')
                        ->latest('date')
                        ->paginate(10);
        //dump($invoices);
        $rutes = [
            "Inicio" => "/",   
            "Facturas" => ""
        ];
        $title=$this->title."ción";
        return view('invoice.index',compact('title','rutes','invoices'));
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

        $invoice= new invoice();
        $costumer = new Costumer ();
        $customers = DB::table('costumer')->where('status','=',1)->latest('created_at')->paginate(10);
        $title="Nueva ".$this->title;
        $estados = $this->estados;
        $urlForm ='Facturas';
        $isnew= true;
        return view('invoice.new',compact('title','rutes','customers','estados','costumer','invoice','urlForm','isnew'));
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

          //  dump(request()->file('file'));
            //Subir archivo -- tener encuenta que en el formulario lleve enctype="multipart/form-data"
            if ($request->file('file')!=null && $request->file('file')!='') {
                $pr_im=$request->file('file')->hashName('');
                $request->file->store('public/docs');
            }else{
                $pr_im=null;
            }
            if(is_null($pr_im)){
             //Mensaje de error   
            }else{
                $timedate = \DateTime::createFromFormat('Y-m-d', $data['date']);            
                if(gettype($timedate)== 'object')
                    $timedate = $timedate->format('Y-m-d H:i:s');
                $id_customer = null;
                if (is_null($data['id_customer'])){              
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
                    'date'=>$timedate,
                    'desp'=>$data['desp'],
                    'type'=>'FACT',
                    'IVA'=> $data['IVA'],
                    'wayToPay'=>$data['wayToPay'],
                    'amount'=>$data['amount'],
                    'ivaincluded'=>$data['ivaincluded']=='on'?true:false,
                    'status'=>1,
                    'id_customer'=>$id_customer,
                    'file'=>$pr_im
                ]); 
            }            
        }         
        return redirect()->route('Facturas.create');
        
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
    public function edit( $id)
    {
        $rutes = [
            "Inicio" => "/",
            "Facturas"=> "/Facturas",            
            "Editar" => ""
        ];
        $invoice = invoice::find($id);
        $costumer =Costumer::find($invoice->id_customer);
        $customers = DB::table('costumer')->where('status','=',1)->latest('created_at')->paginate(10);
        $title="Editar ".$this->title;
        $estados = $this->estados;
        $urlForm ='Facturas/'.$id;
        $isnew= false;
        //dump($costumer);
        return view('invoice.new',compact('title','rutes','customers','estados','costumer','invoice','urlForm','isnew'));        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->all();
        $invoice= invoice::find($id);
        if(isset($data['terminos']) ){     

         //  dump($request->file('file'));
            // //Subir archivo -- tener encuenta que en el formulario lleve enctype="multipart/form-data"
            if ($request->file('file')!=null && $request->file('file')!='') {
                $pr_im=$request->file('file')->hashName('');
                $request->file->store('public/docs');
            }else{
                $pr_im=$invoice->file;
                
            }
            
            $timedate = \DateTime::createFromFormat('Y-m-d', $data['date']);            
                if(gettype($timedate)== 'object')
                    $timedate = $timedate->format('Y-m-d H:i:s');
                $id_customer = null;
                if (is_null($data['id_customer'])){              
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
                
                $data['date']= $timedate;                                              
                $data['ivaincluded']= $data['ivaincluded']=='on'?true:false;                
                $data['id_customer']=$id_customer;
                $date['file'] = "gola";  
                   
                dump($pr_im);             
                dump($data);                          
                $invoice->update($data); 
                
                $invoice->save();                     
        }   
      //return redirect()->route('Facturas.edit',['id'=>$id]);
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
