<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Costumer extends Model
{
    public $table = "costumer";
    protected $fillable = [
        'ruc', 'name', 'logo','email','address','state',
        'country','postal_code','type','origin','phone1','phone2',
        'contact','notes','status'
    ];
}
