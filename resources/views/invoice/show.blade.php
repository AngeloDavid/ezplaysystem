@extends('masterPage')
@section('options')  
    @if (Session::get('user')->id== $invoice->id_company && ($invoice->status == 1 || $invoice->status == 2) )                                               
        <a href="{{ url('/Facturas/'.$invoice->id.'/edit')}}" class="text-danger"><li  data-toggle="tooltip" data-placement="bottom" title="Editar Factura" ><i class="fa fa-edit"></i></li></a>
        <a href="{{ url('/Facturas/'.$invoice->id.'/delete')}}" class="text-danger"><li  data-toggle="tooltip" data-placement="bottom" title="Anular Factura" ><i class="ti-trash"></i></li></a>
    @endif       
    @if (! empty($invoice->file))
        <a target="_blank" href="{{ asset('storage/docs/'. $invoice->file )}}" class="text-secondary"><li  data-toggle="tooltip" data-placement="bottom" title="Descargar Factura" ><i class="ti-cloud-down"></i></li></a>
    @endif
    <a href="{{ url('/Facturas')}}"> <li data-toggle="tooltip" data-placemet="bottom" title="Lista de Facturas"><i class="ti-view-list-alt"></i></li></a>
@endsection
@section('Centro')
<div class="main-content-inner">
<div class="row">
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-area">
                        <div class="invoice-head">
                            <div class="row">
                                <div class="iv-left col-6">
                                    <span>Factura</span>
                                </div>
                                <div class="iv-right col-6 text-md-right">
                                    <span># {{ $invoice->code}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="invoice-address">
                                    <h3>Cliente</h3>
                                    <h5>{{ $customer->name }}</h5>
                                    <p>Teléfono: {{ $customer->phone1 }}</p>
                                    <p>Dirección:{{ $customer->address}},{{  $customer->postal_code }}</p>
                                    <p>          {{ $customer->city }}, {{ $customer->state }}, {{ $customer->country }}</p>
                                    <p>Email: {{ $customer->email }}</p>
                                </div>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <ul class="invoice-date">
                                    <li>Fecha de Factura  :{{ date('d/m/Y', strtotime($invoice->date)) }}</li>
                                    <li>Fecha de Creación :{{ date('d/m/Y', strtotime($invoice->created_at)) }}</li>
                                    <li>Forma de Cobro:  @if ($invoice->wayToPay == 'transfer' )
                                        Transferencia Bancaria
                                    @else
                                        Cheque
                                    @endif  </li>
                                </ul>
                            </div>
                        </div>
                        <div class="invoice-table table-responsive mt-5">
                            <table class="table table-bordered table-hover text-right">
                                <thead>
                                    <tr class="text-capitalize">
                                        <th class="text-center" style="width: 5%;">id</th>
                                        <th class="text-left" style="width: 35%; min-width: 130px;">Descripción</th>                                        
                                        <td></td>
                                        <th style="min-width: 100px">C/U</th>
                                        <th>total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-left">{{ $invoice->desp }}</td>
                                        <td></td>
                                        <td>$  {{ number_format( $prices['subtotal'],2) }}</td>
                                        <td>$  {{ number_format( $prices['subtotal'],2) }}</td>
                                    </tr>                                   
                                    <tr>
                                            <td class="text-center"></td>
                                            <td class="text-left"></td>
                                            <td></td>
                                            <td >SubTotal </td>
                                            <td>$  {{ number_format( $prices['subtotal'],2) }}</td>
                                    </tr>
                                    <tr>
                                            <td class="text-center"></td>
                                            <td class="text-left"></td>
                                            <td></td>
                                            <td>Impuesto:&nbsp;&nbsp; {{ $invoice->tax }}% </td>
                                            <td>$  {{ number_format($prices['iva'],2) }}</td>
                                    </tr>
                                    <tr>
                                            <td class="text-center"></td>
                                            <td class="text-left"></td>
                                            <td></td>
                                            <td>C. T.  {{ $invoice->rate }}%</td>
                                            <td>$  {{ number_format($prices['rate'],2) }}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">Total</td>
                                        <td>$ {{ number_format( $prices['total'],2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Total a Recibir</td>
                                        <td>$ {{ number_format( $prices['toPay'],2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="invoice-buttons text-right">
                        <a target="_blank" href="{{ asset('storage/docs/'. $invoice->file )}}"  class="invoice-btn"> <i class="ti-cloud-down"></i> Descargar Factura</a>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection