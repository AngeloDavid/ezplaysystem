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
                                    @if($company == null)
                                        <h4 class="header-title">Lista de Facturas</h4>
                                    @else
                                        <h4 class="header-title">Facturas Pendientes - <small>{{ $company->name }}</small></h4>                                        
                                        <br>
                                    @endif
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
                                                    <th scope="col">Impuesto (1.5%)</th>                                                    
                                                    <th scope="col">C.T</th>
                                                    <th scope="col">TOTAL</th>
                                                    <th scope="col">Estado</th>
                                                    <th scope="col">Acciones</th>
                                                </tr>
                                                
                                                    <tr class="search-box">
                                                        <td scope="col"><input class="form-control form-control-lg input-rounded" type="text" placeholder="Buscar..." name="code" id="code" ></td>
                                                        <td scope="col"><input class="form-control form-control-lg input-rounded" type="text" placeholder="Buscar..." name="cli" id="cli"></td>
                                                        <td scope="col"><input class="form-control form-control-lg input-rounded" type="text" placeholder="Buscar..." name="desc" id="desc"></td>
                                                        @if (Session::get('user')->id_role=='1' && $title !='Facturación') 
                                                            @if (!is_null($company))
                                                                <td scope="col"><input type="text" class="form-control form-control-lg input-rounded" placeholder="Buscar..." name="emp" id="emp" value="{{ $company->name }}" ></td>        
                                                            @else
                                                                <td scope="col"><input type="text" class="form-control form-control-lg input-rounded" placeholder="Buscar..." name="emp" id="emp" ></td>
                                                            @endif
                                                            @endif                                     
                                                        <td scope="col"><input class="form-control form-control-lg input-rounded" type="date" placeholder="Buscar..." name="fecha" id="fecha" ></td>
                                                        <td scope="col" colspan="4"><input class="form-control form-control-lg input-rounded" type="number" placeholder="Buscar..." name="amount" id="amount" step="0.01" ></td>                                                                                                            
                                                        <td scope="col">
                                                            <select class="custom-select input-rounded w-100" id="status" name="status" >
                                                                <option disabled>Seleccione...</option>
                                                                <option value="-1">Todas</option>
                                                                <option value="1">Ingresadas</option>
                                                                <option value="2">Enviadas al cliente</option>
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
@section('scriptjs')
    <script>
            @if (Session::get('user')->id_role=='1' && $title !='Facturación') 
                var isadmin = true;
                
            @else
            var isadmin = false;
            @endif   
        $(document).ready(function (){
            $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();
                @if (!is_null($company))
                    $('#emp').val(""+{{ $company->name }});    
                @endif                
                $('li').removeClass('active');
                $(this).parent('li').addClass('active');
        
                var url = $(this).attr('href');  
                getInvoices(url);
            });
           
            cleanSearch();
            $('#btn-borrar').click(function(e){
                cleanSearch();
            });
            $('#btn-search').click(function(e){
                $('#htmldt').html(`
                <tr >
                    <td colspan="7">
                        Buscando ...
                    </td>
                </tr>
                `);
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
               getInvoices(urlGEt);
            });

            
            function cleanSearch(){
                var dt= new Date();
                var month = dt.getMonth()<10? '0'+(dt.getMonth()+1):dt.getMonth();
                var day = dt.getDate()<10? '0'+dt.getDate():dt.getDate();
                $('#fecha').val('');
                $('#code').val('');
                $('#cli').val(''); 
                if(isadmin){
                    $('#emp').val('');        
                }                  
                $('#amount').val(null);
                $('#desc').val('');
                $('#status').val(-1);                                
              }

            function getInvoices(urlGEt){
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
        });
    </script>
@endsection