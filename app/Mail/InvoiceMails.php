<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoiceMails extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $factura;
    public $concepto;
    public $estado;
    public $fecha;
    public $isadmin;
    public $action;


/**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username,$factura,$concepto,$estado,$fecha,$isadmin,$action)
    {
        $this->username=$username;
        $this->factura = $factura;
        $this->concepto= $concepto;
        $this->estado =$estado;
        $this->fecha = $fecha;
        $this->isadmin =$isadmin;
        $this->action=$action;
        // dump($this->username,$this->factura,$this->concepto,$this->estado,$this->fecha,$this->isadmin,$this->action);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {        
        return $this->view('e-mails.invoicesNew')->subject('Facturas electonicas -EZPAY');
    }
}
