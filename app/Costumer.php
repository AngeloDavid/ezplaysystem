<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Costumer extends Model
{
    public $table = "costumer";
    protected $fillable = [
        'ruc', 'name', 'logo','email','address','state','city',
        'country','postal_code','type','origin','phone1','phone2',
        'contact','notes','status','id_company'
    ];

    public function invoices()
    {
        return $this->hasMany(invoice::Class,'id_customer');        
    }
}
