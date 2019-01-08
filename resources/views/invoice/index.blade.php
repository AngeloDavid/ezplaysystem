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
                                                @if (Session::get('user')->id_role=='1' && $title !='Facturación') 
                                                    <tr class="search-box">
                                                        <td scope="col"><input class="form-control form-control-lg input-rounded" type="text" placeholder="Buscar..." name="code" id="code" ></td>
                                                        <td scope="col"><input class="form-control form-control-lg input-rounded" type="text" placeholder="Buscar..." name="cli" id="cli"></td>
                                                        <td scope="col"><input class="form-control form-control-lg input-rounded" type="text" placeholder="Buscar..." name="desc" id="desc"></td>
                                                        
                                                            <td scope="col"><input class="form-control form-control-lg input-rounded" type="text" placeholder="Buscar..." name="emp" id="emp" ></td>    
                                                                                                        
                                                        <td scope="col"><input class="form-control form-control-lg input-rounded" type="date" placeholder="Buscar..." name="fecha" id="fecha" ></td>
                                                        <td scope="col"><input class="form-control form-control-lg input-rounded" type="number" placeholder="Buscar..." name="amount" id="amount" ></td>                                                    
                                                        <td scope="col">
                                                            <select class="custom-select input-rounded w-100" id="status" name="status" >
                                                                <option disabled>Seleccione...</option>
                                                                <option value="-1">Todas</option>
                                                                <option value="1">Enviadas</option>
                                                                <option value="2">Recibidas</option>
                                                                <option value="3">Canceladas</option>
                                                                <option value="4">Anuladas</option>
                                                            </select>
                                                        </td>
                                                        <td scope="col">
                                                            <div class="btn-group mb-xl-3 " role="group" aria-label="Basic example">
                                                                <button id="btn-search" type="button" class="btn btn-info"><i class="ti-search"></i></button>
                                                                <button id="btn-borrar" type="button" class="btn btn-info"><i class="ti-eraser"></i></button>                                                            
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif 
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
@section('scriptjs')
    <script>
        $(document).ready(function (){
            @if (Session::get('user')->id_role=='1' && $title !='Facturación') 
                cleanSearch();
            @endif
            $('#btn-borrar').click(function(e){
                cleanSearch();
            });
            $('#btn-search').click(function(e){
                console.log('search');
                var urlGEt = "{{url('/Facturas/buscar')}}/"+
                ($('#code').val().trim() == ''?"%20":$('#code').val().trim()) +"/"+
                ($('#cli').val().trim() == ''?"%20":$('#cli').val().trim())+"/"+   
                ($('#desc').val().trim() == ''?"%20":$('#desc').val().trim())+"/"+
                ($('#emp').val().trim() == ''?"%20":$('#emp').val().trim())+"/"+ 
                ($('#fecha').val().trim() == ''?"%20":$('#fecha').val().trim())+"/"+
                ($('#amount').val().trim() == ''?"%20":$('#amount').val().trim())+"/"+
                ($('#status').val().trim() == ''?"%20":$('#status').val().trim())+"/";
                console.log('url',urlGEt);
                $.ajax({
                    url:urlGEt,
                    method:"GET",
                    success: function(data){
                        console.log('sucss',data);
                        if(data.tpmsj='success'){
                            console.log(data.datahtml);
                            $('#htmldt').html(data.datahtml);
                        }
                    },
                    error :function(data){
                        console.log('error',data);
                    }
                });
            });

            
            function cleanSearch(){
                var dt= new Date();
                var month = dt.getMonth()<10? '0'+(dt.getMonth()+1):dt.getMonth();
                var day = dt.getDate()<10? '0'+dt.getDate():dt.getDate();
                $('#fecha').val('');
                $('#code').val('');
                $('#cli').val('');   
                $('#emp').val('');        
                $('#amount').val(null);
                $('#desc').val('');
                $('#status').val(-1);                                
              }
        });
    </script>
@endsection