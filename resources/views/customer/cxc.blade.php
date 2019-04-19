@extends('masterPage')

@section('scriptcss')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection
@section('Centro')
    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                    <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-10 mt-5">
                                        <h4 class="header-title">Cuentas Por Cobrar</h4>
                                        <h5>{{ $customer->name }}</h5>
                                    </div>                                    
                                </div>
                                @if (count($customer->invoices->where('status','<',4)) == 0)
                                    <div class="alert alert-primary" role="alert">
                                        <h4 class="alert-heading">Sin Cuentas pendientes a pagar</h4>                                        
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
                                                    
                                                        <tr class="search-box">
                                                            <td scope="col"><input class="form-control form-control-lg input-rounded" type="text" placeholder="Buscar..." name="code" id="code" ></td>
                                                            <td scope="col"><input class="form-control form-control-lg input-rounded" type="text" placeholder="Buscar..." name="cli" id="cli"></td>
                                                            <td scope="col"><input class="form-control form-control-lg input-rounded" type="text" placeholder="Buscar..." name="desc" id="desc"></td>
                                                            @if (Session::get('user')->id_role=='1' && $title !='Facturación') 
                                                                <td scope="col"><input class="form-control form-control-lg input-rounded" type="text" placeholder="Buscar..." name="emp" id="emp" ></td>    
                                                                @endif                                     
                                                            <td scope="col"><input class="form-control form-control-lg input-rounded" type="date" placeholder="Buscar..." name="fecha" id="fecha" ></td>
                                                            <td scope="col"><input class="form-control form-control-lg input-rounded" type="number" placeholder="Buscar..." name="amount" id="amount" ></td>                                                    
                                                            <td scope="col">
                                                                <select class="custom-select input-rounded w-100" id="status" name="status" >
                                                                    <option disabled>Seleccione...</option>
                                                                    <option value="-1">Todas</option>
                                                                    <option value="1">Enviadas</option>
                                                                    <option value="2">Procesadas</option>
                                                                    <option value="3">Pagadas por cliente</option>
                                                                    <option value="4">Depo/transf completada</option>
                                                                    <option value="0">Anuladas</option>
                                                                </select>
                                                            </td>
                                                            <td scope="col">
                                                                <div class="btn-group mb-xl-3 " role="group" aria-label="Basic example">
                                                                    <button id="btn-search" type="button" class="btn btn-info"><i class="ti-search"></i></button>
                                                                    <button id="btn-borrar" type="button" class="btn btn-info"><i class="ti-eraser"></i></button>                                                            
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    
                                                </thead>
                                                <tbody id="htmldt">
                                                    @include('invoice.list')                                                
                                                </tbody>
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