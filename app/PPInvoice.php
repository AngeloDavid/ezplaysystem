<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PayPal\Api\Invoice;

class PPInvoice extends Model
{
    protected  $fillable = ['apicontext','NextInvoiceNumber'];


    public function getNextNumberInvoice (){
        try {
            $number = Invoice::generateNumber($this->apiContext);
        } catch (Exception $ex) {
            ResultPrinter::printError("Get Next Invoice Number", "InvoiceNumber", null, null, $ex);
            exit(1);
        }         
        
        return $number;
    }

    public function setApiContext($ClientID,$ClientSecret)
    {
        $this->apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $ClientID,$ClientSecret
            )
        );
    }

    public function getInvoices(Type $var = null)
    {
        
        try {
            
                $invoices = Invoice::getAll(array('page' => 0, 'page_size' => 4, 'total_count_required' => "true"), $this->apiContext);
            } catch (Exception $ex) {
                dd($ex);
                exit(1);
            }
        return $invoices;
    }
}
