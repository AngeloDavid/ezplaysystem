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
        $title = $this->title.'s';
        $rutes = [
            "Inicio" => "/",
            "Clientes"=> "",            
        ];
        $customers = DB::table('costumer')->latest('created_at')->paginate(10);
        if ($request->ajax()) {
            return view('customer.list', ['customers' => $proveedors])->render();  
        }
        return view('customer.index', compact('title','customers','rutes'));
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
            "Clientes"=> "/Clientes",            
            "Nuevo" => ""
        ];
        $title= "Nuevo ".$this->title;
        $estados= $this->estados;
        $isnew =true;
        $urlForm ='Clientes';
        $costumer = new Costumer ();
        return view('customer.new', compact('estados', 'title','isnew','urlForm','costumer','rutes'));
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
        Costumer::create([
            'ruc'=>$data['ruc'], 
            'name'=>$data['name'],
            'email'=>$data['email'],
            'address'=>$data['address'],
            'state'=>$data['state'],
            'country'=>$data['country'],
            'postal_code'=>$data['postal_code'],
            'type'=>'Juridica',
            'origin'=>'Extranjero',
            'phone1'=>$data['phone1'],
            'contact'=>$data['contact'],
            'notes' => $data['notes'],
            'status'=>1
           ]);
           return redirect()->route('Clientes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Costumer  $costumer
     * @return \Illuminate\Http\Response
     */
    public function show(Costumer $costumer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Costumer  $costumer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $data = request()->all();
        $costumer=costumer::find($id);
        $costumer->update ($data);
        $costumer->save();
        return redirect()->route('Clientes.edit',['id'=>$id]);
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
}
