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
           // $pw=encrypt($request->password);
    
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
            $companies = Company::where('id_role','<>','1')->latest('created_at')->paginate(10);

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
        $data['rate'] = $data['rate'] == null? 5.00: $data['rate'];
        if ($request->file('documentNom')!=null && $request->file('documentNom')!='') {
            $pr_dNom=$request->file('documentNom')->hashName('');
            //dump($request->file('documentNom'));
            $request->file('documentNom')->store('public/docsNom');
        }else{
            $pr_dNom=null;
        }
        if ($request->file('documentID')!=null && $request->file('documentID')!='') {
            $pr_dId=$request->file('documentID')->hashName('');
            $request->file('documentID')->store('public/docsID');
        }else{
            $pr_dId=null;
        }
        if ($request->file('logo')!=null && $request->file('logo')!='') {
            $logo=$request->file('logo')->hashName('');
            $request->file('logo')->store('public/logo');
        }else{
            $logo=null;
        }
        try {
            Company::create([
                'ruc'=>$data['ruc'], 
                'name'=>$data['name'],
                'logo'=>$logo,
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
                'legalRepre'=>$data['legalRepre'],
                'documentNom'=> $pr_dNom,
                'documentID'=> $pr_dId,
                'notes' => $data['notes'],
                'rate' => $data['rate'],
                'status'=>1,
                'id_role'=>2
               ]);
               
               return redirect()->route('Empresas.index');
        } catch (\Exception $exception) {            
            switch ($exception->getCode()) {
                case '23000':
                    return back()->with('errmsj','!!Error!! La empresa con RUC:'.$exception->getBindings()[0].'ya se encuentra registrada');
                    break;                
                default:
                return back()->with('errmsj','!!Error!!, Code'.$exception->code.'. Mensaje:'.$exception->message);
                    break;
            }            
        }
        
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
            $title= "Editar ".$this->title." - ".$company->name;
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
    public function update(Request $request,$id)
    {
        if(!is_null(\Session::get('user'))){
            $data = request()->all();  
            $company=Company::find($id);    
            if(isset($data['passwordold']) && isset($data['passwordnow']) && isset($data['passwordconf']))
            if($data['passwordold']!= null && $data['passwordnow']!= null && $data['passwordconf']!= null){          
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
            // dump($request->file('documentNom'));
            if ($request->file('documentNom')!=null && $request->file('documentNom')!='') {
                $pr_dNom=$request->file('documentNom')->hashName('');
                $request->file('documentNom')->store('public/docsNom');
            }else{
                $pr_dNom=$company->documentNom;
            }
            if ($request->file('documentID')!=null && $request->file('documentID')!='') {
                $pr_dId=$request->file('documentID')->hashName('');
                $request->file('documentID')->store('public/docsID');
            }else{
                $pr_dId=$company->documentID;
            }
            if ($request->file('logo')!=null && $request->file('logo')!='') {
                $logo=$request->file('logo')->hashName('');
                $request->file('logo')->store('public/logo');
            }else{
                $logo=$company->logo;
            }
            $data['documentNom']=$pr_dNom;
            $data['documentID']=$pr_dId; 
            $data['logo']= $logo;
            try {
                $company->update ($data);        
                $company->save();
                \Session::flash('flash_success',"Informacion actualizada correctamente.");
                if($data['isprofile'] == 1){
                    \Session::put('user',$company);
                    return redirect()->route('Empresas.profile');
                }else{
                    return redirect()->route('Empresas.edit',['id'=>$id]);
                }
            } catch (\Exception $exception) {
                switch ($exception->getCode()) {
                    case '23000':
                        return back()->with('errmsj','!!Error!! La empresa con RUC: '.$exception->getBindings()[0].' ya se encuentra registrada');
                        break;                
                    default:
                    return back()->with('errmsj','!!Error!!, Code'.$exception->code.'. Mensaje:'.$exception->message);
                        break;
                }
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
        if(!is_null(\Session::get('user'))){
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
