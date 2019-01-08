<?php

namespace App\Http\Controllers;

use App\invoice;
use App\Costumer;
use App\Company;
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
        if(!is_null(\Session::get('user'))){
            $company = \Session::get('user');
            $invoices = DB::table('invoice')                        
                            ->leftjoin('costumer','invoice.id_customer','=','costumer.id')
                            ->select('invoice.id','invoice.code','invoice.date','invoice.desp','invoice.created_at','invoice.amount','invoice.file','invoice.status','costumer.id as id_customer','costumer.name')
                            ->where('invoice.id_company','=',$company->id)
                            ->latest('date')
                            ->paginate(10);
            //dump($invoices);
            $rutes = [
                "Inicio" => "/",   
                "Facturas" => ""
            ];
            $title=$this->title."ción";
            return view('invoice.index',compact('title','rutes','invoices'));
        }else{
            return redirect('/logout'); 
        }
    }

    public function allinvoices()
    {
        if($this->isadmin()){
            $invoices = DB::table('invoice')                        
                        ->leftjoin('costumer','invoice.id_customer','=','costumer.id')
                        ->leftjoin('company','invoice.id_company','=','company.id')
                        ->select('invoice.id','invoice.code','invoice.date','invoice.desp','invoice.created_at','invoice.amount','invoice.file','invoice.status','costumer.id as id_customer','costumer.name','company.id as id_company','company.name as company')
                        ->latest('date')
                        ->paginate(10);
        
            $rutes = [
                "Inicio" => "/",   
                "Facturas" => ""
            ];
            $title="Facturas por Empresa";
            return view('invoice.index',compact('title','rutes','invoices'));    
        }else{
            return redirect('/logout');
        }        
    }

    public function searchinvoice($code,$cli,$desc,$emp,$fecha,$amount,$status)
    {
        //numero de inoices por pagina
        $pages=10;
        if($this->isadmin()){          
            $code = trim($code) == ''?'':'%'.$code.'%';
            $cli = trim($cli) == ''?'':'%'.$cli.'%';
            $desc = trim($desc) == ''?'':'%'.$desc.'%';
            $emp = trim($emp) == ''?'':'%'.$emp.'%';
            $fecha= trim($fecha) == ''?'':'%'.$fecha.'%';
            $amount= trim($amount) == ''?'':'%'.$amount.'%';
            $status  = $status == -1? '' : $status;
            // dump($code,$cli,$desc,$emp,$fecha,$amount,$status);
            if($status != ''){
                $invoices = DB::table('invoice')                        
                        ->leftjoin('costumer','invoice.id_customer','=','costumer.id')
                        ->leftjoin('company','invoice.id_company','=','company.id')
                        ->Where('invoice.code','like',$code)
                        ->orWhere('costumer.name','like',$cli)
                        ->orWhere('invoice.desp','like',$desc)
                        ->orWhere('company.name','like',$emp)
                        ->orWhere('invoice.date','like',$fecha)
                        ->orWhere('invoice.amount','like',$amount)
                        ->orWhere('invoice.status','like',$status)
                        ->select('invoice.id','invoice.code','invoice.date','invoice.desp','invoice.created_at','invoice.amount','invoice.file','invoice.status','costumer.id as id_customer','costumer.name','company.id as id_company','company.name as company')
                        ->latest('date')
                        ->paginate($pages);
            }else{
                if ($code == '' && $cli == '' &&
                    $desc == '' && $emp == '' && 
                    $fecha == '' && $amount== '' ) {
                        $invoices = DB::table('invoice')                        
                            ->leftjoin('costumer','invoice.id_customer','=','costumer.id')
                            ->leftjoin('company','invoice.id_company','=','company.id')
                            ->select('invoice.id','invoice.code','invoice.date','invoice.desp','invoice.created_at','invoice.amount','invoice.file','invoice.status','costumer.id as id_customer','costumer.name','company.id as id_company','company.name as company')
                            ->latest('date')
                            ->paginate($pages);
                }else{
                    $invoices = DB::table('invoice')                        
                        ->leftjoin('costumer','invoice.id_customer','=','costumer.id')
                        ->leftjoin('company','invoice.id_company','=','company.id')
                        ->Where('invoice.code','like',$code)
                        ->orWhere('costumer.name','like',$cli)
                        ->orWhere('invoice.desp','like',$desc)
                        ->orWhere('company.name','like',$emp)
                        ->orWhere('invoice.date','like',$fecha)
                        ->orWhere('invoice.amount','like',$amount)                        
                        ->select('invoice.id','invoice.code','invoice.date','invoice.desp','invoice.created_at','invoice.amount','invoice.file','invoice.status','costumer.id as id_customer','costumer.name','company.id as id_company','company.name as company')
                        ->latest('date')
                        ->paginate($pages);                            
                }
                
            }

            $title="Facturas por Empresa";
            $invoicelist = view('invoice.list', compact('invoices','title'));
            $contents =  $invoicelist->render();
            //dump($contents);
            return response()->json(array(
                'tpmsj'=>'success',
                'message'=>'Consulta realizada con exito',
                'datahtml'=> $contents
            )
            );
            // return view('invoice.index',compact('title','rutes','invoices'));    
        }else{
            return redirect('/logout');
        }    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!is_null(\Session::get('user'))){
            $rutes = [
                "Inicio" => "/",   
                "Facturas" => "/Facturas",
                "Nuevo"=>""
            ];

            $invoice= new invoice();
            $costumer = new Costumer ();
            $customers = DB::table('costumer')->where('status','=',1)->where('id_company','=',\Session::get('user')->id)->latest('created_at')->paginate(10);
            $title="Nueva ".$this->title;
            $estados = $this->estados;
            $urlForm ='Facturas';
            $isnew= true;
            return view('invoice.new',compact('title','rutes','customers','estados','costumer','invoice','urlForm','isnew'));
        }else{
            return redirect('/logout');
        }
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
        if(!is_null(\Session::get('user'))) 
        {
            if ( isset($data['terminos']) ){ 
                $company= \Session::get('user');
                //Subir archivo -- tener encuenta que en el formulario lleve enctype="multipart/form-data"
                if ($request->file('file')!=null && $request->file('file')!='') {
                    $pr_im=$request->file('file')->hashName('');
                    $request->file->store('public/docs');
                }else{
                    $pr_im=null;
                }
                if(is_null($pr_im)){
                    return back()->with('errmsj','Error, el archivo ingreasado no es correcto');
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
                            'status'=>1,
                            'id_company'=>$company->id
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
                        'file'=>$pr_im,
                        'id_company'=>$company->id
                    ]); 
                   // dump($company->id);
                }            
            }         
            \Session::flash('flash_success',"Factura ingresada correctamente");      
            return redirect()->route('Facturas.create');
        }else{
            return redirect('/login');
        }        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!is_null(\Session::get('user'))){
            $invoice = invoice::find($id);
            $rutes = [
                "Inicio" => "/",
                "Facturas"=> "/Facturas",            
                $invoice->code => ""
            ];
            $prices=[
                "subtotal"=>0,
                "iva"=>0,
                "total"=>0
            ];
            $customer =Costumer::find($invoice->id_customer);               
            if($invoice->iva=="0%"){
                $prices['subtotal'] = $invoice->amount;
                $prices['total'] = $invoice->amount;
            }else{
                $iva =substr(trim($invoice->IVA), 0, -1);            
                
                if($invoice->ivaincluded){         
                    $iva = ((float) $iva / 100) + 1;
                    $prices['subtotal'] = ($invoice->amount)/$iva  ;
                    $prices['iva'] =$invoice->amount -$prices['subtotal']  ;
                    $prices['total'] = $invoice->amount;
                }else{
                    $iva = (float) $iva / 100;
                    $prices['subtotal'] = $invoice->amount;
                    $prices['iva'] = $invoice->amount * $iva  ;
                    $prices['total'] = $prices['subtotal']+ $prices['iva'];
                }
            }        

        //  dump($prices);
        
            
            $title="Mostrar ".$this->title;
            $estados = $this->estados;
            $urlForm ='Facturas/'.$id;                
            return view('invoice.show',compact('title','rutes','estados','customer','invoice','urlForm','prices'));        
        }else{
                return redirect('/logout');
            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        if(!is_null(\Session::get('user'))){
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
        }else{
            return redirect('/logout');
        }
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
        if(!is_null(\Session::get('user'))){
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
                    unset($data['file']);
                    $data['file']=$pr_im;                         
                // dump($data);
                    $invoice->update($data); 
                // dump($invoice);
                    $invoice->save();                  
            }   
            return redirect()->route('Facturas.edit',['id'=>$id]);
        }else{
            return redirect('/logout');
        }
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

    public function anular($id) {
        if(!is_null(\Session::get('user'))){
            $invoice=invoice::find($id);
            if( $invoice->status <3 ){
                $prom=DB::table('invoice')
                                ->where('id',$id)
                                ->update(['status'=>'4']);
            }        
            return redirect()->route('Facturas.index');   
        }else{
            return redirect('/logout');
        }
    }

    public function changestatus($id) {
        if(!is_null(\Session::get('user'))){
            $costumer=invoice::find($id);

            if( $costumer->status <3 ){
                $status =$costumer->status +1;
                $prom=DB::table('invoice')
                                ->where('id',$id)
                                ->update(['status'=>$status]);
            }        
            return redirect()->route('Empresas.allinvoices');   
        }else{
            return redirect('/logout');
        }
    }

    private function isadmin()
    {
        if(!is_null(\Session::get('user'))){
            $company = \Session::get('user');
            if($company->id_role ==1)
                return true;
            else {
                return false;
            }
        }else {
            return false;
        }
    }

}
