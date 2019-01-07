<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    var $title="Empresa";
        
    var $estados = [
            "01"=>"Azuay",
            "02"=>"Bolivar",
            "03"=>"Cañar",
            "04"=>"Carchi",
            "05"=>"Cotopaxi",
            "06"=>"Chimborazo",
            "07"=>"El Oro",
            "08"=>"Esmeraldas",
            "09"=>"Guayas",
            "10"=>"Imbabura",
            "11"=>"Loja",
            "12"=>"Los Rios",
            "13"=>"Manabi",
            "14"=>"Morona Santiago",
            "15"=>"Napo",
            "16"=>"Pastaza",
            "17"=>"Pichincha",
            "18"=>"Tungurahua",
            "19"=>"Zamora Chinchipe",
            "20"=>"Galapagos",
            "21"=>"Sucumbios",
            "22"=>"Orellana",
            "23"=>"Santo Domingo de los Tsachilas",
            "24"=>"Santa Elena"
        ];
    
        public function home(){
            $title="Login";
            return view('login',compact('title'));
        }
        public function login(Request $request){
            \Session::put('user',array());
            
            $pw=encrypt($request->password);
    
            if ($request->userApp!=null && $request->userApp!='') {
                $Usuarios = DB::table('users')
                        ->select('email','password')
                        ->where('userApp','=',$request->userApp)
                        ->whereIn('id_role', [1, 2])
                        ->first();
                if ($Usuarios!=null) {
                    if (decrypt($Usuarios->password)===$request->password) {
                        $User = DB::table('users')
                        ->where('userApp','=',$request->userApp)
                        ->first();
                        \Session::put('user',$User);
                                   
                        return redirect('/');
                    }else{
                        return back()->with('errmsj','Usuario o Contraseña Incorrectos.');
                    }
                }else{
                    return back()->with('errmsj','Usuario o Contraseña Incorrectos.');
                }
            }else{
                return back()->with('errmsj','Usuario o Contraseña Incorrectos.');
            }        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
     public function index(Request $request)
    {
        
        $title = $this->title.'s';
        $rutes = [
            "Inicio" => "/",
            "Empresas"=> "",            
        ];
        $companies = DB::table('company')->latest('created_at')->paginate(10);
        if ($request->ajax()) {
            return view('company.list', ['companies' => $companies])->render();  
        }
        return view('company.index', compact('title','companies','rutes'));
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
            "Empresas"=> "/Empresas",            
            "Nuevo" => ""
        ];
        $title= "Nuevo ".$this->title;
        $estados= $this->estados;
        $isnew =true;
        $urlForm ='Empresas';
        $company = new Company ();
        return view('company.new', compact('estados', 'title','isnew','urlForm','company','rutes'));
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

        Company::create([
            'ruc'=>$data['ruc'], 
            'name'=>$data['name'],
            'email'=>$data['email'],
            'userApp' =>$data['ruc'],
            'password' => encrypt($data['ruc']),
            'address'=>$data['address'],
            'city'=>$data['city'],
            'state'=>$data['state'],
            'country'=>$data['country'],
            'postal_code'=>$data['postal_code'],
            'type'=>'Juridica',
            'phone1'=>$data['phone1'],
            'contact'=>$data['contact'],
            'notes' => $data['notes'],
            'status'=>1,
            'id_role'=>2
           ]);
           return redirect()->route('Empresas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rutes = [
            "Inicio" => "/",
            "Empresas"=> "/Empresas",            
            "Editar" => ""
        ];
        $company=Company::find($id);
        $isnew=false;
        $estados= $this->estados;
        $title= "Editar ".$this->title;
        $urlForm ='Empresas/'.$id;
        return view ('company.new',compact( 'estados', 'title','isnew','urlForm','company','rutes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $data = request()->all();
        $company=Company::find($id);
        $company->update ($data);
        $company->save();
        return redirect()->route('Empresas.edit',['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
    
    public function activar($id) {
        $company=Company::find($id);
        if( $company->status == 1){
            $prom=DB::table('company')
                            ->where('id',$id)
                            ->update(['status'=>'0']);
        }else{
            $prom=DB::table('company')
                            ->where('id',$id)
                            ->update(['status'=>'1']);
            
        }        
        return redirect()->route('Empresas.index');   
    }

    public function resetarPWD($id)
    {
        $company=Company::find($id);
        $company->password = encrypt($company->ruc);
        $company->save();
        return redirect()->route('Empresas.edit',['id'=>$id]);
    }
}
