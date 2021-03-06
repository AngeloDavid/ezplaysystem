<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $table = "company";
    protected $fillable = [
        'ruc', 'name', 'logo','email','userApp','password','address','state','city',
        'country','postal_code','type','origin','phone1','phone2',
        'contact','legalRepre','documentNom','documentID','notes','rate','status','id_role'
    ];

    public function invoices()
    {
        return $this->hasMany(invoice::Class,'id_company');        
    }
}
