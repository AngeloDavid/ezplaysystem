<?php

namespace App\Http\Controllers;

use App\Costumer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $customers = DB::table('costumer')->where('id_company','=',\Session::get('user')->id)->latest('created_at')->paginate(5);
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
            $ruc = trim($ruc) == ''?'':'%'.$ruc.'%';
            $name = trim($name) == ''?'':'%'.$name.'%';            
            $date= trim($date) == ''?'':'%'.$date.'%';
            $place= trim($place) == ''?'':'%'.$place.'%';
            $status  = $status == -1? '' : $status;
            if($status != ''){
                $customers = DB::table('costumer')
                    ->where('id_company','=',$company->id)
                    -> where(
                        function ($query)use ($ruc,$name,$date,$place,$status)
                        {
                                $query->orWhere('costumer.ruc','like',$ruc)
                                ->orWhere('costumer.name','like',$name)
                                ->orWhere('costumer.created_at','like',$date)
                                ->orWhere('costumer.address','like',$place)
                                ->orWhere('costumer.city','like',$place)
                                ->orWhere('costumer.country','like',$place)
                                ->orWhere('costumer.status','like',$status);
                        }
                    )->latest('created_at')->paginate(5);
                   
            }else {
                if ($ruc == '' && $name == '' && $date== '' && $place == '' ){
                    $customers = DB::table('costumer')
                    ->where('id_company','=',$company->id)
                    ->latest('created_at')->paginate(5);
                }else{
                    $customers = DB::table('costumer')
                    ->where('id_company','=',$company->id)
                    -> where(
                        function ($query)use ($ruc,$name,$date,$place,$status)
                        {
                                $query->orWhere('costumer.ruc','like',$ruc)
                                ->orWhere('costumer.name','like',$name)
                                ->orWhere('costumer.created_at','like',$date)
                                ->orWhere('costumer.address','like',$place)
                                ->orWhere('costumer.city','like',$place)
                                ->orWhere('costumer.country','like',$place);
                        }
                    )->latest('created_at')->paginate(5);
                }
            }

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
            $isnew =true;
            $urlForm ='Clientes';
            $costumer = new Costumer ();
            return view('customer.new', compact('estados', 'title','isnew','urlForm','costumer','rutes'));
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
            $title= "Editar ".$this->title;
            $urlForm ='Clientes/'.$id;
            return view ('customer.new',compact( 'estados', 'title','isnew','urlForm','costumer','rutes'));
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
}
