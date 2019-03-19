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
                                                    <tr class="search-box">
                                                        <td scope="col"><input class="form-control form-control-lg input-rounded" type="text" placeholder="Buscar..." name="ruc" id="ruc" ></td>
                                                        <td scope="col"><input class="form-control form-control-lg input-rounded" type="text" placeholder="Buscar..." name="name" id="name"></td>
                                                        <td scope="col"><input class="form-control form-control-lg input-rounded" type="date" placeholder="Buscar..." name="date" id="date"></td>
                                                        <td scope="col"><input class="form-control form-control-lg input-rounded" type="text" placeholder="Buscar..." name="place" id="place"></td>
                                                        <td scope="col">
                                                            <select class="custom-select input-rounded w-100" id="status" name="status" >
                                                                <option disabled>Seleccione...</option>
                                                                <option value="-1">Todas</option>
                                                                <option value="1">Habilitados</option>
                                                                <option value="0">Deshabilitados</option>                                                                
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
                                                        @include('customer.list')
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
@section('scriptjs')
    <script>
        $(document).ready(function(){
            cleanSearch();

            $('#btn-borrar').click(function(e){
                cleanSearch();
            });
            
            $('#btn-search').click(function(e){
                console.log('search');
                var urlGEt = isadmin?"{{url('/Facturas/buscar_admin')}}/":"{{url('/Facturas/buscar')}}/";                                 
                urlGEt +=($('#code').val().trim() == ''?"%20":$('#code').val().trim()) +"/"+
                ($('#cli').val().trim() == ''?"%20":$('#cli').val().trim())+"/"+   
                ($('#desc').val().trim() == ''?"%20":$('#desc').val().trim())+"/";
                if(isadmin){
                    urlGEt+=($('#emp').val().trim() == ''?"%20":$('#emp').val().trim())+"/";
                }                
                urlGEt+=($('#fecha').val().trim() == ''?"%20":$('#fecha').val().trim())+"/"+
                ($('#amount').val().trim() == ''?"%20":$('#amount').val().trim())+"/"+
                ($('#status').val().trim() == ''?"%20":$('#status').val().trim())+"/";
                console.log('url',urlGEt);
                getclientes(urlGEt);
            });

           // metodos 
           function cleanSearch() {
            $('#ruc').val('');
            $('#name').val('');
            $('#date').val('')  ;
            $('#place').val('');
            $('#status').val(-1);
           } 

           // obtener clientes
           function getclientes(urlGEt){
            $.ajax({
                url:urlGEt,
                method:"GET",
                success: function(data){
                    console.log('sucss',data);
                    if(data.tpmsj='success'){                            
                        if(data.datahtml=='')
                        {
                            $('#htmldt').html(`
                            <tr >
                                <td colspan="7">
                                    No existe registros
                                </td>
                            </tr>
                            `);
                        }else{
                            $('#htmldt').html(data.datahtml);
                        }                            
                    }
                },
                error :function(data){
                    console.log('error',data);
                }
            });
        }
        } )
    </script>    
@endsection