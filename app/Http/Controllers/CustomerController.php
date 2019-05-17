<?php

namespace App\Http\Controllers;

use App\Costumer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    var $title="Cliente";
    
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
        "US"=>"UNITED STATES",
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
            $title = $this->title.'s';
            $rutes = [
                "Inicio" => "/",
                "Clientes"=> "",            
            ];
            $customers = Costumer::where('id_company','=',\Session::get('user')->id)->latest('created_at')->paginate(5);
        //    dd($customers[0]);
            if ($request->ajax()) {
                $invoicelist = view('customer.list', compact('customers'));
                $contents =  $invoicelist->render();
                return response()->json(array(
                        'tpmsj'=>'success',
                        'message'=>'Consulta realizada con exito',
                        'datahtml'=> $contents
                )
                );
            }
             return view('customer.index', compact('title','customers','rutes'));
        }else{
            return redirect('/logout');
        }
    }

    public function searchCustomer($ruc,$name,$date,$place,$status)
    {
        if(!is_null(\Session::get('user'))){
            $company = \Session::get('user');                 
            $ruc = trim($ruc) == ''?'%%':'%'.$ruc.'%';
            $name = trim($name) == ''?'%%':'%'.$name.'%';            
            $date= trim($date) == ''?'%%':'%'.$date.'%';
            $place= trim($place) == ''?'%%':'%'.$place.'%';
            $status  = $status == -1? '%%' : $status;
            DB::enableQueryLog();
            $customers = Costumer::where(
                function ($q) use($ruc,$name,$date,$place,$status) {
                    $q->Where('id_company','=',\Session::get('user')->id);
                    $q->Where('costumer.ruc','like',$ruc);
                    $q->Where('costumer.name','like',$name);
                    $q->Where('costumer.created_at','like',$date);
                    // $q->Where('costumer.address','like',$place);
                    // $q->Where('costumer.city','like',$place);
                    // $q->Where('costumer.country','like',$place);
                    $q->Where('costumer.status','like',$status);
                })
                ->latest('created_at')->paginate(5);
                 dd((DB::getQueryLog()));
            // dd($customers);
                /*-> where(
                    function ($query)use ($ruc,$name,$date,$place,$status)
                    {
                            $query->Where('costumer.ruc','like',$ruc)
                            ->Where('costumer.name','like',$name)
                            ->Where('costumer.created_at','like',$date)
                            ->Where('costumer.address','like',$place)
                            ->Where('costumer.city','like',$place)
                            ->Where('costumer.country','like',$place)
                            ->Where('costumer.status','like',$status);
                    }
                )*/
                // ->latest('created_at')->paginate(5);


            $invoicelist = view('customer.list', compact('customers'));
            $contents =  $invoicelist->render();
            return response()->json(array(
                    'tpmsj'=>'success',
                    'message'=>'Consulta realizada con exito',
                    'datahtml'=> $contents
            )
            );
        }else{
            return response()->json(array(
                'tpmsj'=>'error',
                'message'=>'Problemas de conexion',
                'datahtml'=> ''
            )
            );
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
                "Clientes"=> "/Clientes",            
                "Nuevo" => ""
            ];
            $title= "Nuevo ".$this->title;
            $estados= $this->estados;
            $countries = $this->countries;
            $isnew =true;
            $urlForm ='Clientes';
            $costumer = new Costumer ();
            return view('customer.new', compact('countries','estados', 'title','isnew','urlForm','costumer','rutes'));
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
        if(!is_null(\Session::get('user'))) {
            $company =\Session::get('user');
            
            $costumer = DB::table('costumer')
                    ->where('id_company','=',$company->id)
                    ->Where('costumer.ruc','like',$data['ruc'])
                    ->select('costumer.ruc')
                    ->first();
            if(is_null($costumer) ){
                Costumer::create([
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
                    'phone1'=>$data['phone1'],
                    'contact'=>$data['contact'],
                    'notes' => $data['notes'],
                    'status'=>1,
                    'id_company' =>$company->id
                ]);
                \Session::flash('flash_success',"Cliente :".$data['name']."  Ingresado Correctatmente");      
                return redirect()->route('Clientes.create');
            }else{
                return back()->with('errmsj','No pueder haber 2 o mas clientes con el mismo  RUC/CI/ID. ('.$data['ruc'].')');
            }            
        }else{
           return redirect('/login');
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Costumer  $costumer
     * @return \Illuminate\Http\Response
     */
    public function show(Costumer $costumer)
    {        
        return redirect()->back();   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Costumer  $costumer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!is_null(\Session::get('user'))){
            $rutes = [
                "Inicio" => "/",
                "Clientes"=> "/Clientes",            
                "Editar" => ""
            ];
            $costumer=Costumer::find($id);
            $isnew=false;
            $estados= $this->estados;
            $countries = $this->countries;
            $title= "Editar ".$this->title;
            $urlForm ='Clientes/'.$id;
            return view ('customer.new',compact( 'countries','estados', 'title','isnew','urlForm','costumer','rutes'));
        }else{
            return redirect('/logout');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Costumer  $costumer
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        if(!is_null(\Session::get('user'))){
        $data = request()->all();
        $costumer=costumer::find($id);
        $costumer->update ($data);
        $costumer->save();
        return redirect()->route('Clientes.edit',['id'=>$id]);
        }else{
            return redirect('/logut');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Costumer  $costumer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Costumer $costumer)
    {
        //
    }

    public function activar($id) {
        if(!is_null(\Session::get('user'))){
            $costumer=costumer::find($id);
            if( $costumer->status == 1){
                $prom=DB::table('costumer')
                                ->where('id',$id)
                                ->update(['status'=>'0']);
            }else{
                $prom=DB::table('costumer')
                                ->where('id',$id)
                                ->update(['status'=>'1']);
                
            }        
            return redirect()->route('Clientes.index');   
        }else{
            return redirect('/logout');
        }
    }

    public function getInvoices($id)
    {
        $customer = Costumer::find($id);
        $rutes = [
            "Inicio" => "/",
            "Clientes"=> "/Clientes",            
            "Cuentas por Cobrar" => ""
        ];
        $costumer=Costumer::find($id);        
        $invoices= $costumer->invoices;
        
        $title= "Cuentas Por Cobrar";        
        return view ('customer.cxc',compact('customer','title','rutes','invoices'));
    }

    
}
