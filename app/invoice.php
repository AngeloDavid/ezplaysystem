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

    public function ClTotales($amount,$tax,$rate,$ivaincluded,$rateTotal)
    {
        $rateTotal = (float) $rateTotal/100;
        $rate = (float) ($rate/100);
        $tax = (float) ($tax/100);
        $prices=[
            "subtotal"=>0,
            "iva"=>0,
            'rate'=>0,
            "total"=>0,
            "toPay"=>0
        ];
        $prices["subtotal"]= $ivaincluded==true?$amount/($tax+1):$amount;
        $prices["iva"] = $ivaincluded==true? $amount -$prices["subtotal"] : $amount * $tax;
        
        // CT sobre el calculo del tax. se aumenta   
        // $prices["rate"] = ( $prices["subtotal"] + $prices["iva"] ) * $rate;

        $prices["rate"] = $amount * $rate;
        $prices ["total"] = $prices["subtotal"] + $prices["iva"] + $prices["rate"];

        // $prices["total"] = $ivaincluded==true?(($amount*$rate)+$amount):(($amount*($rate+$tax))+$amount);
        $prices ["toPay"] = $prices["total"] - ($prices["total"] * ($rateTotal+ $tax));
        return $prices;
    }

    public function getStatus($status)
    {
        $estado ='';
        switch ($status) {
            case 1:
               $estado='Ingresada';
                break;   
            case 2:
                $estado='Enviada al cliente';
                break;                
            case 3:
                $estado='Pagada por cliente';
                break;   
            case 4:
                $estado='Depositada o transferida a su cuenta';
                break;       
            case 0:
                $estado='Anulado';
                break;               
            default:
                $estado = 'Estado erroneo';
                break;
        }
        return $estado;
    }
    
}
