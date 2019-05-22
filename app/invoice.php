<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    public $table = "invoice";    
    protected $fillable = [
        'code','date', 'desp', 'type','IVA','tax','wayToPay','file',
        'amount','ivaincluded','status','id_company','id_customer','rate'
    ];

    public function CalTotales($amount,$tax,$rate,$ivaincluded)
    {
        $prices=[
            "subtotal"=>0,
            "iva"=>0,
            "totalIva"=>0,
            'rate'=>0,
            "total"=>0
        ];
        if($tax==0){
            $prices['subtotal'] = $amount;
            $prices['totalIva'] = $amount;
        }else{
            if($ivaincluded){         
                $tax = ((float) $tax / 100) + 1;
                $prices['subtotal'] = ($amount)/$tax  ;
                $prices['iva'] =$amount -$prices['subtotal']  ;
                $prices['totalIva'] = $amount;
            }else{
                $tax = (float)  $tax  / 100;
                $prices['subtotal'] = $amount;
                $prices['iva'] = $amount * $tax  ;
                $prices['totalIva'] = $prices['subtotal']+ $prices['iva'];
            }
        
        }        
        $rate= (float) $rate / 100 ;
        $prices['rate'] =  $prices['totalIva']  * $rate;
        $prices['total'] = $prices['rate'] + $prices['totalIva'];

        return $prices;
    }
    
}
