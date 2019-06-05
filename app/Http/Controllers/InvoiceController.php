<?php

namespace App\Http\Controllers;

use App\invoice;
use App\Costumer;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMails;
use Maatwebsite\Excel\Facades\Excel;
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

    var $countries = [
        "US"=>"UNITED STATES",
        "AL"=>"ALBANIA",
        "DZ"=>"ALGERIA",
        "AD"=>"ANDORRA",
        "AO"=>"ANGOLA",
        "AI"=>"ANGUILLA",
        "AG"=>"ANTIGUA & BARBUDA",
        "AR"=>"ARGENTINA",
        "AM"=>"ARMENIA",
        "AW"=>"ARUBA",
        "AU"=>"AUSTRALIA",
        "AT"=>"AUSTRIA",
        "AZ"=>"AZERBAIJAN",
        "BS"=>"BAHAMAS",
        "BH"=>"BAHRAIN",
        "BB"=>"BARBADOS",
        "BY"=>"BELARUS",
        "BE"=>"BELGIUM",
        "BZ"=>"BELIZE",
        "BJ"=>"BENIN",
        "BM"=>"BERMUDA",
        "BT"=>"BHUTAN",
        "BO"=>"BOLIVIA",
        "BA"=>"BOSNIA & HERZEGOVINA",
        "BW"=>"BOTSWANA",
        "BR"=>"BRAZIL",
        "VG"=>"BRITISH VIRGIN ISLANDS",
        "BN"=>"BRUNEI",
        "BG"=>"BULGARIA",
        "BF"=>"BURKINA FASO",
        "BI"=>"BURUNDI",
        "KH"=>"CAMBODIA",
        "CM"=>"CAMEROON",
        "CA"=>"CANADA",
        "CV"=>"CAPE VERDE",
        "KY"=>"CAYMAN ISLANDS",
        "TD"=>"CHAD",
        "CL"=>"CHILE",
        "C2"=>"CHINA",
        "CO"=>"COLOMBIA",
        "KM"=>"COMOROS",
        "CG"=>"CONGO - BRAZZAVILLE",
        "CD"=>"CONGO - KINSHASA",
        "CK"=>"COOK ISLANDS",
        "CR"=>"COSTA RICA",
        "CI"=>"CÔTE D’IVOIRE",
        "HR"=>"CROATIA",
        "CY"=>"CYPRUS",
        "CZ"=>"CZECH REPUBLIC",
        "DK"=>"DENMARK",
        "DJ"=>"DJIBOUTI",
        "DM"=>"DOMINICA",
        "DO"=>"DOMINICAN REPUBLIC",
        "EC"=>"ECUADOR",
        "EG"=>"EGYPT",
        "SV"=>"EL SALVADOR",
        "ER"=>"ERITREA",
        "EE"=>"ESTONIA",
        "ET"=>"ETHIOPIA",
        "FK"=>"FALKLAND ISLANDS",
        "FO"=>"FAROE ISLANDS",
        "FJ"=>"FIJI",
        "FI"=>"FINLAND",
        "FR"=>"FRANCE",
        "GF"=>"FRENCH GUIANA",
        "PF"=>"FRENCH POLYNESIA",
        "GA"=>"GABON",
        "GM"=>"GAMBIA",
        "GE"=>"GEORGIA",
        "DE"=>"GERMANY",
        "GI"=>"GIBRALTAR",
        "GR"=>"GREECE",
        "GL"=>"GREENLAND",
        "GD"=>"GRENADA",
        "GP"=>"GUADELOUPE",
        "GT"=>"GUATEMALA",
        "GN"=>"GUINEA",
        "GW"=>"GUINEA-BISSAU",
        "GY"=>"GUYANA",
        "HN"=>"HONDURAS",
        "HK"=>"HONG KONG SAR CHINA",
        "HU"=>"HUNGARY",
        "IS"=>"ICELAND",
        "IN"=>"INDIA",
        "ID"=>"INDONESIA",
        "IE"=>"IRELAND",
        "IL"=>"ISRAEL",
        "IT"=>"ITALY",
        "JM"=>"JAMAICA",
        "JP"=>"JAPAN",
        "JO"=>"JORDAN",
        "KZ"=>"KAZAKHSTAN",
        "KE"=>"KENYA",
        "KI"=>"KIRIBATI",
        "KW"=>"KUWAIT",
        "KG"=>"KYRGYZSTAN",
        "LA"=>"LAOS",
        "LV"=>"LATVIA",
        "LS"=>"LESOTHO",
        "LI"=>"LIECHTENSTEIN",
        "LT"=>"LITHUANIA",
        "LU"=>"LUXEMBOURG",
        "MK"=>"MACEDONIA",
        "MG"=>"MADAGASCAR",
        "MW"=>"MALAWI",
        "MY"=>"MALAYSIA",
        "MV"=>"MALDIVES",
        "ML"=>"MALI",
        "MT"=>"MALTA",
        "MH"=>"MARSHALL ISLANDS",
        "MQ"=>"MARTINIQUE",
        "MR"=>"MAURITANIA",
        "MU"=>"MAURITIUS",
        "YT"=>"MAYOTTE",
        "MX"=>"MEXICO",
        "FM"=>"MICRONESIA",
        "MD"=>"MOLDOVA",
        "MC"=>"MONACO",
        "MN"=>"MONGOLIA",
        "ME"=>"MONTENEGRO",
        "MS"=>"MONTSERRAT",
        "MA"=>"MOROCCO",
        "MZ"=>"MOZAMBIQUE",
        "NA"=>"NAMIBIA",
        "NR"=>"NAURU",
        "NP"=>"NEPAL",
        "NL"=>"NETHERLANDS",
        "NC"=>"NEW CALEDONIA",
        "NZ"=>"NEW ZEALAND",
        "NI"=>"NICARAGUA",
        "NE"=>"NIGER",
        "NG"=>"NIGERIA",
        "NU"=>"NIUE",
        "NF"=>"NORFOLK ISLAND",
        "NO"=>"NORWAY",
        "OM"=>"OMAN",
        "PW"=>"PALAU",
        "PA"=>"PANAMA",
        "PG"=>"PAPUA NEW GUINEA",
        "PY"=>"PARAGUAY",
        "PE"=>"PERU",
        "PH"=>"PHILIPPINES",
        "PN"=>"PITCAIRN ISLANDS",
        "PL"=>"POLAND",
        "PT"=>"PORTUGAL",
        "QA"=>"QATAR",
        "RE"=>"RÉUNION",
        "RO"=>"ROMANIA",
        "RU"=>"RUSSIA",
        "RW"=>"RWANDA",
        "WS"=>"SAMOA",
        "SM"=>"SAN MARINO",
        "ST"=>"SÃO TOMÉ & PRÍNCIPE",
        "SA"=>"SAUDI ARABIA",
        "SN"=>"SENEGAL",
        "RS"=>"SERBIA",
        "SC"=>"SEYCHELLES",
        "SL"=>"SIERRA LEONE",
        "SG"=>"SINGAPORE",
        "SK"=>"SLOVAKIA",
        "SI"=>"SLOVENIA",
        "SB"=>"SOLOMON ISLANDS",
        "SO"=>"SOMALIA",
        "ZA"=>"SOUTH AFRICA",
        "KR"=>"SOUTH KOREA",
        "ES"=>"SPAIN",
        "LK"=>"SRI LANKA",
        "SH"=>"ST. HELENA",
        "KN"=>"ST. KITTS & NEVIS",
        "LC"=>"ST. LUCIA",
        "PM"=>"ST. PIERRE & MIQUELON",
        "VC"=>"ST. VINCENT & GRENADINES",
        "SR"=>"SURINAME",
        "SJ"=>"SVALBARD & JAN MAYEN",
        "SZ"=>"SWAZILAND",
        "SE"=>"SWEDEN",
        "CH"=>"SWITZERLAND",
        "TW"=>"TAIWAN",
        "TJ"=>"TAJIKISTAN",
        "TZ"=>"TANZANIA",
        "TH"=>"THAILAND",
        "TG"=>"TOGO",
        "TO"=>"TONGA",
        "TT"=>"TRINIDAD & TOBAGO",
        "TN"=>"TUNISIA",
        "TM"=>"TURKMENISTAN",
        "TC"=>"TURKS & CAICOS ISLANDS",
        "TV"=>"TUVALU",
        "UG"=>"UGANDA",
        "UA"=>"UKRAINE",
        "AE"=>"UNITED ARAB EMIRATES",
        "GB"=>"UNITED KINGDOM",        
        "UY"=>"URUGUAY",
        "VU"=>"VANUATU",
        "VA"=>"VATICAN CITY",
        "VE"=>"VENEZUELA",
        "VN"=>"VIETNAM",
        "WF"=>"WALLIS & FUTUNA",
        "YE"=>"YEMEN",
        "ZM"=>"ZAMBIA",
        "ZW"=>"ZIMBABWE"
        ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!is_null(\Session::get('user'))){
           
            $company = \Session::get('user');
            $invoices = invoice::where('invoice.id_company','=',$company->id)
                            ->leftjoin('costumer','invoice.id_customer','=','costumer.id')
                            ->leftjoin('company','invoice.id_company','=','company.id')
                            ->select('invoice.id','invoice.code','invoice.date','invoice.desp','invoice.created_at','invoice.amount','invoice.tax','invoice.ivaincluded','invoice.rate','invoice.file','invoice.status','costumer.id as id_customer','costumer.name','invoice.id_company','company.rate as rateTotal')                            
                            ->latest('date')
                            ->paginate(10);
            //dump($invoices);
            if ($request->ajax()) {
                $invoicelist = view('invoice.list', compact('invoices','title'));
                $contents =  $invoicelist->render();
                return response()->json(array(
                    'tpmsj'=>'success',
                    'message'=>'Consulta realizada con exito',
                    'datahtml'=> $contents
                )
                );
            }
            $rutes = [
                "Inicio" => "/",   
                "Facturas" => ""
            ];
            $title=$this->title."ción";
            $company =null;
            return view('invoice.index',compact('title','rutes','invoices','company'));
        }else{
            return redirect('/logout'); 
        }
    }
    public function exportEXCELINVOICES()
    {    
        $invoices = invoice::all();
        dd($invoices[0]);
       // return Excel::download($invoices, 'report.xlsx');    

        // Excel::download('invoice', function($excel) {
        
          
        
        //     $excel->sheet('Users', function($sheet) use($invoices) {
        
        //     $sheet->fromArray($invoices);
        
        // });
        
        // })->export('xlsx');
    }

    public function allinvoices(Request $request)
    {
        if($this->isadmin()){
            $company = Company::find($request->id);            
            if($company == null){
                $invoices = invoice::leftjoin('costumer','invoice.id_customer','=','costumer.id')
                        ->leftjoin('company','invoice.id_company','=','company.id')
                        ->select('invoice.id','invoice.code','invoice.date','invoice.desp','invoice.created_at','invoice.amount','invoice.tax','invoice.ivaincluded','invoice.rate','invoice.file','invoice.status','costumer.id as id_customer','costumer.name','company.id as id_company','company.name as company','company.rate as rateTotal')
                        ->latest('date')
                        ->paginate(10);
             }else{
                $invoices = invoice::where('invoice.id_company','=',$company->id)
                    ->leftjoin('costumer','invoice.id_customer','=','costumer.id')
                    ->leftjoin('company','invoice.id_company','=','company.id')
                    ->select('invoice.id','invoice.code','invoice.date','invoice.desp','invoice.created_at','invoice.amount','invoice.tax','invoice.ivaincluded','invoice.rate','invoice.file','invoice.status','costumer.id as id_customer','costumer.name','company.id as id_company','company.name as company','company.rate as rateTotal')
                    ->latest('date')
                    ->paginate(10);
             }
            
            // dd($invoices);
            $rutes = [
                "Inicio" => "/",   
                "Facturas" => ""
            ];
            $title="Facturas por Empresa";
            if ($request->ajax()) {
                $invoicelist = view('invoice.list', compact('invoices','title'));
                $contents =  $invoicelist->render();
                return response()->json(array(
                    'tpmsj'=>'success',
                    'message'=>'Consulta realizada con exito',
                    'datahtml'=> $contents
                )
                );
            }
            
            return view('invoice.index',compact('title','rutes','invoices','company'));    
        }else{
            return redirect('/logout');
        }        
    }

    public function searchinvoiceadmin($code,$cli,$desc,$emp,$fecha,$amount,$status)
    {
        //numero de invoices por pagina
        $pages=3;
        if($this->isadmin()){          
            $code = trim($code) == ''?'%%':'%'.$code.'%';
            $cli = trim($cli) == ''?'%%':'%'.$cli.'%';
            $desc = trim($desc) == ''?'%%':'%'.$desc.'%';
            $emp = trim($emp) == ''?'%%':'%'.$emp.'%';
            $fecha= trim($fecha) == ''?'%%':'%'.$fecha.'%';
            $amount= trim($amount) == ''?'%%':'%'.$amount.'%';
            $status  = $status == -1? '%%' : $status;
            // dump($code,$cli,$desc,$emp,$fecha,$amount,$status);

            $invoices = invoice::leftjoin('costumer','invoice.id_customer','=','costumer.id')
                        ->leftjoin('company','invoice.id_company','=','company.id')
                        ->Where('invoice.code','like',$code)
                        ->Where('costumer.name','like',$cli)
                        ->Where('invoice.desp','like',$desc)
                        ->Where('company.name','like',$emp)
                        ->Where('invoice.date','like',$fecha)
                        ->Where('invoice.amount','like',$amount)
                        ->Where('invoice.status','like',$status)
                        ->select('invoice.id','invoice.code','invoice.date','invoice.desp','invoice.created_at','invoice.amount','invoice.tax','invoice.ivaincluded','invoice.rate','invoice.file','invoice.status','costumer.id as id_customer','costumer.name','company.id as id_company','company.name as company','company.rate as rateTotal')
                        ->latest('date')
                        ->paginate($pages);
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

    public function searchinvoice($code,$cli,$desc,$fecha,$amount,$status)
    {
        //numero de inoices por pagina
        $pages=10;
        if(!is_null(\Session::get('user'))){     
            $company = \Session::get('user');     
            $code = trim($code) == ''?'%%':'%'.$code.'%';
            $cli = trim($cli) == ''?'%%':'%'.$cli.'%';
            $desc = trim($desc) == ''?'%%':'%'.$desc.'%';            
            $fecha= trim($fecha) == ''?'%%':'%'.$fecha.'%';
            $amount= trim($amount) == ''?'%%':'%'.$amount.'%';
            $status  = $status == -1? '%%' : $status;

            $invoices = invoice::leftjoin('costumer','invoice.id_customer','=','costumer.id')
                        ->leftjoin('company','invoice.id_company','=','company.id')
                        ->where('invoice.id_company','=',$company->id)
                        ->where(
                            function ($query)use ($code,$cli,$desc,$fecha,$amount,$status)
                            {
                                $query->Where('invoice.code','like',$code)
                                ->Where('costumer.name','like',$cli)
                                ->Where('invoice.desp','like',$desc)
                                ->Where('invoice.date','like',$fecha)
                                ->Where('invoice.amount','like',$amount)
                                ->Where('invoice.status','like',$status);
                            }
                        )                            
                        ->select('invoice.id','invoice.code','invoice.date','invoice.desp','invoice.created_at','invoice.amount','invoice.tax','invoice.ivaincluded','invoice.rate','invoice.file','invoice.status','costumer.id as id_customer','costumer.name','company.id as id_company','company.name as company','company.rate as rateTotal')
                        ->latest('date')
                        ->paginate($pages);

            $title="Facturación";
            $invoicelist = view('invoice.list', compact('invoices','title'));
            $contents =  $invoicelist->render();            
            return response()->json(array(
                'tpmsj'=>'success',
                'message'=>'Consulta realizada con exito',
                'datahtml'=> $contents
            )
            );            
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
            $countries = $this->countries;
            $urlForm ='Facturas';
            $isnew= true;
            return view('invoice.new',compact('title','rutes','customers','countries','estados','costumer','invoice','urlForm','isnew'));
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
                $data['tax'] = $data['tax'] == null? 0:$data['tax'];    
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
                        $country = $customer_new->country;
                    }else {
                        $id_customer = $data['id_customer'];
                        $country= Costumer::find($id_customer)->country;
                    }
                    if($country != 'US'){
                        $tax = (float) $data['tax'] + 1.5;
                    }else{
                        $tax =$data['tax'];
                    }
                    // dd($id_customer);   
                    
                    $data['ivaincluded'] = isset( $data['ivaincluded']) == true? $data['ivaincluded']: 'off';
                    $invoiceCreated = invoice::create([
                        'code'=>$data['code'],
                        'date'=>$timedate,
                        'desp'=>$data['desp'],
                        'type'=>'FACT',
                        'IVA'=> '0%',
                        'tax' =>$tax,
                        'rate'=> $data['rate'],
                        'wayToPay'=>$data['wayToPay'],
                        'amount'=>$data['amount'],
                        'ivaincluded'=>$data['ivaincluded']=='on'?true:false,
                        'status'=>1,
                        'id_customer'=>$id_customer,
                        'file'=>$pr_im,
                        'id_company'=>$company->id
                    ]); 
                    Mail::to('pay@ezrose.com')->send( new InvoiceMails(\Session::get('user')->name,$data['code'],$data['desp'],'Ingresada',$timedate,date("Y-m-d H:i:s"),true,' ingresado '));
                   Mail::to(\Session::get('user')->email)->send( new InvoiceMails(\Session::get('user')->name,$data['code'],$data['desp'],'Ingresada',$timedate,date("Y-m-d H:i:s"),false,' ingresada '));
                   
                }            
            }             
            \Session::flash('flash_success',"Factura ingresada correctamente");      
            return redirect()->route('Facturas.edit',['id'=>$invoiceCreated->id]);
            //return redirect()->route('Facturas.create');
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
            $customer =Costumer::find($invoice->id_customer);
            $company = Company::find($invoice->id_company);
            $prices = $invoice->ClTotales($invoice->amount,$invoice->tax,$invoice->rate,$invoice->ivaincluded,$company->rate);
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
            $countries = $this->countries;
            $urlForm ='Facturas/'.$id;
            $isnew= false;
            //dump($costumer);
            return view('invoice.new',compact('title','rutes','customers','countries','estados','costumer','invoice','urlForm','isnew'));        
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
                    $data['IVA']= '0%';                                        
                    if(isset($data['ivaincluded'])){
                        $data['ivaincluded']= $data['ivaincluded']=='on'?true:false;
                    }else{
                        $data['ivaincluded']= false;
                    }                    
                    $data['id_customer']=$id_customer; 
                    unset($data['file']);
                    $data['file']=$pr_im;                         
                //  dump($data);
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
                                ->update(['status'=>'0']);
            }        
            return redirect()->route('Facturas.index');   
        }else{
            return redirect('/logout');
        }
    }

    public function changestatus($id) {
        if(!is_null(\Session::get('user'))){
            
            $invoice=invoice::find($id);
            $company = Company::find($invoice->id_company);
            if( $invoice->status <4 ){
                $status =$invoice->status +1;
                $prom=DB::table('invoice')
                                ->where('id',$id)
                                ->update(['status'=>$status]);
            }  
            $estado='';
            $invoice=invoice::find($id);
            switch ($invoice->status) {
                case 1:
                   $estado='ingresada';
                    break;   
                case 2:
                    $estado='Enviada al cliente';
                    break;                
                case 3:
                    $estado='Pagada por cliente';
                    break;   
                case 4:
                    $estado='Depositada o transferida a su cuenta';
                    break;               
                default:
                    # code...
                    break;
            } 
            // dd($company);
            Mail::to($company->email)->send( new InvoiceMails($company->name,$invoice->code,$invoice->desp,$estado,$invoice->date,date("Y-m-d H:i:s"),false,$estado    ));
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
