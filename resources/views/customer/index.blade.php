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
                                        <h4 class="header-title">Lista de Clientes</h4>
                                    </div>
                                    <div class="col-2 mt-5 text-right">
                                            <a href="{{ url('/Clientes/create')}}" class="btn btn-rounded btn-primary mb-3"><i class="ti-plus"></i>&nbsp;&nbsp;&nbsp; Nuevo</a>
                                    </div>
                                </div>
                                @if (count($customers)<1)
                                    <div class="alert alert-primary" role="alert">
                                        <h4 class="alert-heading">Sin Clientes</h4>
                                        <p>Sus clientes aún no han sido ingresados</p>
                                        <hr>
                                        <p class="mb-0">    <a href="{{ url('/Clientes/create')}}" class=" mb-3"><i class="ti-plus"></i>&nbsp;&nbsp;&nbsp; Nuevo Cliente</a> </p>
                                    </div>
                                @else                                
                                    <div class="single-table">
                                        <div class="table-responsive">
                                            <table class="table table-hover progress-table text-center">
                                                <thead class="text-uppercase">
                                                    <tr>
                                                        <th scope="col">RUC/CI/ID</th>
                                                        <th scope="col">Nombre</th>
                                                        <th scope="col">Fecha de creacion</th>
                                                        <th scope="col">Dirrecion</th>
                                                        <th scope="col">Estado</th>
                                                        <th scope="col">Acciones</th>
                                                    </tr>
                                                </thead>
                                                @include('customer.list')
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
@section('scriptjs')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
@endsection