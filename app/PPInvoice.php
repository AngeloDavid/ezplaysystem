<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PayPal\Api\Invoice;
use PayPal\Api\Address;
use PayPal\Api\BillingInfo;
use PayPal\Api\Cost;
use PayPal\Api\Currency;
use PayPal\Api\InvoiceAddress;
use PayPal\Api\InvoiceItem;
use PayPal\Api\MerchantInfo;
use PayPal\Api\PaymentTerm;
use PayPal\Api\Phone;
use PayPal\Api\ShippingInfo;
use App\Company;
use App\Costumer;
use App\invoice as Ezinvoice;


class PPInvoice extends Model
{
    protected  $fillable = ['apicontext','NextInvoiceNumber',
                            'note','email','name','lastname','bussinessName',
                            //phone number
                            'countryCode','NationalNumber',
                            //address
                            'line1','city','state','postalCode','countryCodeAd',
                            //tax
                            'currency',''
        ];

    public function __construct()
    {
        $payPalConfig= \Config::get('paypal');
        $cliente_id = $payPalConfig['mode'] == 'sandbox'? $payPalConfig['sandbox']['username']:$payPalConfig['live']['username'] ;
        $password = $payPalConfig['mode'] == 'sandbox'? $payPalConfig['sandbox']['password']:$payPalConfig['live']['password'] ;
        $this->setApiContext($cliente_id,$password,$payPalConfig['settings']); 
    }

    public function getNextNumberInvoice (){
        try {
            $number = Invoice::generateNumber($this->apiContext);
        } catch (Exception $ex) {
            ResultPrinter::printError("Get Next Invoice Number", "InvoiceNumber", null, null, $ex);
            exit(1);
        }         
        
        return $number;
    }

    public function setApiContext($ClientID,$ClientSecret,$settings)
    {
        
        $this->apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $ClientID,$ClientSecret
            )
        );
        $this->apiContext->setConfig($settings);
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

    public function createInvoice1(Company $company,Costumer $costumer, EzInvoice $invoice )
    {
        
        $invoice = new Invoice();
        /*Invoice Info
        Fill in all the information that is required for invoice APIs
        */
        $invoice
            ->setMerchantInfo(new MerchantInfo())
            ->setBillingInfo(array(new BillingInfo()))
            ->setNote("Medical Invoice 16 Jul, 2013 PST")
            ->setPaymentTerm(new PaymentTerm())
            ->setShippingInfo(new ShippingInfo());
        
        /*Merchant Info
        A resource representing merchant information that can be used to identify merchant
        */
        $invoice->getMerchantInfo()
            ->setEmail($company->email)
            ->setFirstName($company->legalRepre)
            ->setLastName("")
            ->setbusinessName($company->name)
            ->setPhone(new Phone())
            ->setAddress(new Address());

        $invoice->getMerchantInfo()->getPhone()
            ->setCountryCode("001")
            ->setNationalNumber($company->phone1);

        //Address Information
        //The address used for creating the invoice

        $invoice->getMerchantInfo()->getAddress()
            ->setLine1($company->address)
            ->setCity($company->city)
            ->setState('OR')
            ->setPostalCode($company->postal_code)
            ->setCountryCode($company->country);

        //Billing Information
        //Set the email address for each billing

        $billing = $invoice->getBillingInfo();
        $billing[0]
            ->setEmail($costumer->email);

        $billing[0]->setBusinessName($costumer->name)            
            ->setAddress(new InvoiceAddress());

        $billing[0]->getAddress()
            ->setLine1($costumer->address)
            ->setCity($costumer->city)
            ->setState('OR')
            ->setPostalCode($costumer->postal_code)
            ->setCountryCode($costumer->country);
        // ItemsLista
        //You could provide the list of all items for detailed breakdown of invoice

        $items = array();
        $items[0] = new InvoiceItem();
        $items[0]
            ->setName($invoice->desp)
            ->setQuantity(1)
            ->setUnitPrice(new Currency());

        $items[0]->getUnitPrice()
            ->setCurrency("USD")
            ->setValue($invoice->amount);
       // Tax Item
        //You could provide Tax information to each item.

        $tax = new \PayPal\Api\Tax();
        $tax->setPercent(1)->setName("Costo de Transaccion");
        $items[0]->setTax($invoice->tax);

        $invoice->setItems($items);
        // Final Discount
        // You /can add final discount to the invoice as shown below. You could either use "percent" or "value" when providing the discount

        $cost = new Cost();
        $cost->setPercent("2");
        $invoice->setDiscount($cost);

        $invoice->getPaymentTerm()
            ->setTermType("NET_45");
     
            // Shipping Information
        $invoice->getShippingInfo()
            ->setFirstName("Sally")
            ->setLastName("Patient")
            ->setBusinessName("Not applicable")
            ->setPhone(new Phone())
            ->setAddress(new InvoiceAddress());

        $invoice->getShippingInfo()->getPhone()
            ->setCountryCode("001")
            ->setNationalNumber("5039871234");

        $invoice->getShippingInfo()->getAddress()
            ->setLine1("1234 Main St.")
            ->setCity("Portland")
            ->setState("OR")
            ->setPostalCode("97217")
            ->setCountryCode("US");
        // Logo
        // You can set the logo in the invoice by providing the external URL pointing to a logo

        $invoice->setLogoUrl('https://www.paypalobjects.com/webstatic/i/logo/rebrand/ppcom.svg');
        // For Sample Purposes Only.

        // dd($invoice);
        try {
        // Create Invoice
        // Create an invoice by calling the invoice->create() method with a valid ApiContext (See bootstrap.php for more on ApiContext)

            $invoice->create($this->apiContext);
        } catch (Exception $ex) {
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            dd($ex->getData());
            // ResultPrinter::printError("Create Invoice", "Invoice", null, $request, $ex);
            exit(1);
        }
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY

        // ResultPrinter::printResult("Create Invoice", "Invoice", $invoice->getId(), $request, $invoice);

        return $invoice;       
    }

    public function createInvoice(Company $company,Costumer $costumer, EzInvoice $invoice)
    {
        $invoice = new Invoice();
        $invoice
            ->setMerchantInfo(new MerchantInfo())
            ->setBillingInfo(array(new BillingInfo()))
            ->setNote("Medical Invoice 16 Jul, 2013 PST")
            ->setPaymentTerm(new PaymentTerm())
            ->setShippingInfo(new ShippingInfo());

        $invoice->getMerchantInfo()
            ->setEmail("jaypatel512-facilitator@hotmail.com")
            ->setFirstName("Dennis")
            ->setLastName("Doctor")
            ->setbusinessName("Medical Professionals, LLC")
            ->setPhone(new Phone())
            ->setAddress(new Address());
        
        $invoice->getMerchantInfo()->getPhone()
            ->setCountryCode("001")
            ->setNationalNumber("5032141716");

        $invoice->getMerchantInfo()->getAddress()
            ->setLine1("1234 Main St.")
            ->setCity("Portland")
            ->setState("OR")
            ->setPostalCode("97217")
            ->setCountryCode("US");
        
        $billing = $invoice->getBillingInfo();
        $billing[0]
            ->setEmail("example@example.com");
    
        $billing[0]->setBusinessName("Jay Inc")
            ->setAdditionalInfo("This is the billing Info")
            ->setAddress(new InvoiceAddress());

        $billing[0]->getAddress()
            ->setLine1("1234 Main St.")
            ->setCity("Portland")
            ->setState("OR")
            ->setPostalCode("97217")
            ->setCountryCode("US");
        
        $items = array();
        $items[0] = new InvoiceItem();
        $items[0]
            ->setName("Sutures")
            ->setQuantity(100)
            ->setUnitPrice(new Currency());
    
        $items[0]->getUnitPrice()
            ->setCurrency("USD")
            ->setValue(5);
        
        $tax = new \PayPal\Api\Tax();
        $tax->setPercent(1)->setName("Local Tax on Sutures");
        $items[0]->setTax($tax);

        $items[1] = new InvoiceItem();

        $item1discount = new Cost();
        $item1discount->setPercent("3");
        $items[1]
            ->setName("Injection")
            ->setQuantity(5)
            ->setDiscount($item1discount)
            ->setUnitPrice(new Currency());
        
        $items[1]->getUnitPrice()
            ->setCurrency("USD")
            ->setValue(5);

        $tax2 = new \PayPal\Api\Tax();
        $tax2->setPercent(3)->setName("Local Tax on Injection");
        $items[1]->setTax($tax2);
            
        $invoice->setItems($items);

        $cost = new Cost();
        $cost->setPercent("2");
        $invoice->setDiscount($cost);

        $invoice->getPaymentTerm()
            ->setTermType("NET_45");

            $invoice->getShippingInfo()
            ->setFirstName("Sally")
            ->setLastName("Patient")
            ->setBusinessName("Not applicable")
            ->setPhone(new Phone())
            ->setAddress(new InvoiceAddress());
        
        $invoice->getShippingInfo()->getPhone()
            ->setCountryCode("001")
            ->setNationalNumber("5039871234");
        
        $invoice->getShippingInfo()->getAddress()
            ->setLine1("1234 Main St.")
            ->setCity("Portland")
            ->setState("OR")
            ->setPostalCode("97217")
            ->setCountryCode("US");
        
        $invoice->setLogoUrl('https://www.paypalobjects.com/webstatic/i/logo/rebrand/ppcom.svg');
        
        $request = clone $invoice;

        //  dd($request);
        try {
            $invoice->create($this->apiContext);
            } catch (Exception $ex) {
                dd($ex);
        }

        return $invoice;
    }
}
