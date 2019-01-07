<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    public $table = "invoice";    
    protected $fillable = [
        'code','date', 'desp', 'type','IVA','wayToPay','file',
        'amount','ivaincluded','status','id_company','id_customer'
    ];
}
