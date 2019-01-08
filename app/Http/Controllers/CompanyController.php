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
                $Usuarios = DB::table('company')
                        ->select('userApp','password')
                        ->where('userApp','=',$request->userApp)
                        ->whereIn('id_role', [1, 2])
                        ->first();
                if ($Usuarios!=null) {
                    if (decrypt($Usuarios->password)===$request->password) {
                        $User = DB::table('company')
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
        if($this->isadmin()){
            $title = $this->title.'s';
            $rutes = [
                "Inicio" => "/",
                "Empresas"=> "",            
            ];
            $companies = DB::table('company')->latest('created_at')->where('id_role','<>','1')->paginate(10);
            if ($request->ajax()) {
                return view('company.list', ['companies' => $companies])->render();  
            }
            return view('company.index', compact('title','companies','rutes'));
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
        if($this->isadmin()){
            $rutes = [
                "Inicio" => "/",
                "Empresas"=> "/Empresas",            
                "Nuevo" => ""
            ];
            $title= "Nuevo ".$this->title;
            $estados= $this->estados;
            $isnew =true;
            $isprofile=false;
            $urlForm ='Empresas';
            $company = new Company ();
            return view('company.new', compact('estados', 'title','isnew','isprofile','urlForm','company','rutes'));
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
        if($this->isadmin()){
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
        }else{
            return redirect('/logout');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return redirect()->route('Empresas.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        if($this->isadmin()){
            $rutes = [
                "Inicio" => "/",
                "Empresas"=> "/Empresas",            
                "Editar" => ""
            ];
            $company=Company::find($id);
            $isnew=false;
            $isprofile=false;
            $estados= $this->estados;
            $title= "Editar ".$this->title;
            $urlForm ='Empresas/'.$id;
            return view ('company.new',compact( 'estados', 'title','isnew','isprofile','urlForm','company','rutes'));
        }else{
            return redirect('/logout');
        }
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
        if($this->isadmin()){
        $data = request()->all();       
        if($data['passwordold']!= null && $data['passwordnow']!= null && $data['passwordconf']!= null){
            $company=Company::find($id);            
            if(decrypt($company->password)===$data['passwordold']){
                if($data['passwordnow'] ==  $data['passwordconf'] ){
                    $data['password']= encrypt($data['passwordnow']);                     
                }else{
                    return back()->with('errmsj','Error las contraseñas no coinciden');
                }
            }else {                
                return back()->with('errmsj','Error la contraseña es incorrecta');
            }
        }
        
        $company=Company::find($id);
        $company->update ($data);
        $company->save();
        \Session::flash('flash_success',"Informacion actualizada correctamente.");      
        if($data['isprofile'] == 1){
            return redirect()->route('Empresas.profile');
        }else{
            return redirect()->route('Empresas.edit',['id'=>$id]);
        }
        }else{
            return redirect('logout');
        }
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
        if($this->isadmin()){
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
        }else{
            return redirect('/logout');
        }
    }

    public function resetarPWD($id)
    {
        if($this->isadmin()){
            $company=Company::find($id);
            $company->password = encrypt($company->ruc);
            $company->save();
            return redirect()->route('Empresas.edit',['id'=>$id]);
        }else{
            return redirect('/logut');
        }
    }

    public function profile()
    {
        $rutes = [
            "Inicio" => "/",
            "Perfil"=> "",    
        ];
        $company= \Session::get('user');
        $company=Company::find($company->id);
        $isnew=false;
        $isprofile=true;
        $estados= $this->estados;
        $title= "Perfil de la  ".$this->title;
        $urlForm ='Empresas/'.$company->id;
        return view ('company.new',compact( 'estados', 'title','isnew','isprofile','urlForm','company','rutes'));
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
