@extends('masterPage')
@section('Centro')
<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
                <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-10 mt-5">
                                    <h4 class="header-title">Lista de Facturas</h4>
                                </div>
                                <div class="col-2 mt-5 text-right">
                                        <a href="{{ url('/Facturas/create')}}" class="btn btn-rounded btn-primary mb-3"><i class="ti-plus"></i>&nbsp;&nbsp;&nbsp; Nuevo</a>
                                </div>
                            </div>
                            @if (count($invoices)<1)
                                <div class="alert alert-primary" role="alert">
                                    <h4 class="alert-heading">Sin Facturas</h4>
                                    <p>Por favor ingrese una factura para comenzar</p>
                                    <hr>
                                    <p class="mb-0">    <a href="{{ url('/Facturas/create')}}" class=" mb-3"><i class="ti-plus"></i>&nbsp;&nbsp;&nbsp; Nueva Factura</a> </p>
                                </div>
                            @else                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table table-hover progress-table text-center">
                                            <thead class="text-uppercase">
                                                <tr>
                                                    <th scope="col">code</th>
                                                    <th scope="col">Cliente</th>
                                                    <th scope="col">Descripcion</th>
                                                    @if (Session::get('user')->id_role=='1' && $title !='Facturación')  
                                                        <th scope="col">Empresa</th>    
                                                    @endif                                                    
                                                    <th scope="col">Fecha</th>
                                                    <th scope="col">Monto</th>                                                    
                                                    <th scope="col">Estado</th>
                                                    <th scope="col">Acciones</th>
                                                </tr>
                                            </thead>
                                            @include('invoice.list')
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
        </div>
        
    </div>
</div>  
@endsection